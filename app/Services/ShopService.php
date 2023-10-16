<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\Proxy\CategoryRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ColorRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ProductRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\TagRepositoryProxyContract;
use App\Contracts\Services\ShopServiceContract;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\API\Shop\CategoryResource;
use App\Http\Resources\API\Shop\ColorResource;
use App\Http\Resources\API\Shop\ProductResource;
use App\Http\Resources\API\Shop\RecentProductResource;
use App\Http\Resources\API\Shop\SingleProductResource;
use App\Http\Resources\API\Shop\TagResource;
use App\Models\Product as Model;
use Illuminate\Support\Facades\Cache;

class ShopService extends CoreService implements ShopServiceContract
{
    public function __construct(
        private readonly ProductRepositoryProxyContract $repository,
        private readonly CategoryRepositoryProxyContract $categoryRepository,
        private readonly ColorRepositoryProxyContract $colorRepository,
        private readonly TagRepositoryProxyContract $tagRepository,
    )
    {
        parent::__construct();
    }

    public function paginate(int $quantity, array $data): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $page = $data['page'];
        $data = [
            'categories' => $data['category_ids'],
            'colors' => $data['color_ids'],
            'tags' => $data['tag_ids'],
            'prices' => $data['prices'],
            'title' => $data['title'],
        ];
        sort($data['categories']);
        sort($data['colors']);
        sort($data['tags']);
        $filter = app()->make(ProductFilter::class,['queryParams' => array_filter($data)]);
        $products = $this->getRepository()->paginate($quantity, $page, $filter, true);
        return ProductResource::collection($products);
    }

    public function getCategories(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = $this->getCategoryRepository()->getAll();
        return CategoryResource::collection($categories);
    }

    public function getColors(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = $this->getColorRepository()->getAll();
        return ColorResource::collection($categories);
    }

    public function getTags(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = $this->getTagRepository()->getAll();
        return TagResource::collection($categories);
    }

    public function getPrices(): array
    {
        $minPrice = $this->getRepository()->getMinPrice();
        $maxPrice = $this->getRepository()->getMaxPrice();

        return [
            'min' => $minPrice,
            'max' => $maxPrice,
        ];
    }

    public function getProduct(int $id): SingleProductResource
    {
        $product = $this->getRepository()->findById($id);
        return SingleProductResource::make($product);
    }

    public function getRecentProducts(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
       $products = $this->getRepository()->getRecentProducts();
        return RecentProductResource::collection($products);
    }

    /**
     * @return ProductRepositoryProxyContract
     */
    public function getRepository(): ProductRepositoryProxyContract
    {
        return $this->repository;
    }

    /**
     * @return CategoryRepositoryProxyContract
     */
    public function getCategoryRepository(): CategoryRepositoryProxyContract
    {
        return $this->categoryRepository;
    }

    /**
     * @return ColorRepositoryProxyContract
     */
    public function getColorRepository(): ColorRepositoryProxyContract
    {
        return $this->colorRepository;
    }

    /**
     * @return TagRepositoryProxyContract
     */
    public function getTagRepository(): TagRepositoryProxyContract
    {
        return $this->tagRepository;
    }
}
