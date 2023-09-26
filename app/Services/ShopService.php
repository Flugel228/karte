<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\ProductRepositoryContract;
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
        private readonly ProductRepositoryContract $repository
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
        $filterKey = md5(serialize($data));
        $products = Cache::rememberForever("products:shop:filter_key:$filterKey:page:$page", function () use ($quantity, $page, $filter) {
            return $this->getRepository()->paginate($quantity, $page, $filter);
        });


        return ProductResource::collection($products);
    }

    public function getCategories(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = Cache::get('categories:all');
        return CategoryResource::collection($categories);
    }

    public function getColors(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = Cache::get('colors:all');
        return ColorResource::collection($categories);
    }

    public function getTags(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = Cache::get('tags:all');
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
        $count = (int)$this->getRepository()->count();
        $products = $count < 5 ? $this->getRepository()->getRecentProducts($count) : $this->getRepository()->getRecentProducts();
        return RecentProductResource::collection($products);
    }

    /**
     * @return ProductRepositoryContract
     */
    public function getRepository(): ProductRepositoryContract
    {
        return $this->repository;
    }
}
