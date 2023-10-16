<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\Proxy\CategoryRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ColorRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ImageRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\ProductRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\TagRepositoryProxyContract;
use App\Contracts\Services\ProductServiceContract;
use App\Http\Filters\ProductFilter;
use App\Http\Resources\Client\Admin\Product\IndexResource;
use App\Services\Traits\DataCachingTrait;
use App\Services\Traits\StorageTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductService extends CoreService implements ProductServiceContract
{
    use StorageTrait, DataCachingTrait;

    public function __construct(
        private readonly ProductRepositoryProxyContract $repository,
        private readonly ImageRepositoryProxyContract $imageRepository,
        private readonly CategoryRepositoryProxyContract $categoryRepository,
        private readonly ColorRepositoryProxyContract $colorRepository,
        private readonly TagRepositoryProxyContract $tagRepository,
    )
    {
        parent::__construct();
    }

    /**
     * @param int $quantity
     * @param int $page
     * @param string $path
     * @return AnonymousResourceCollection
     * @throws BindingResolutionException
     */
    public function paginate(int $quantity, int $page, string $path): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = [
            'categories' => [],
            'colors' => [],
            'tags' => [],
            'prices' => [],
            'title' => [],
        ];

        $filter = app()->make(ProductFilter::class,['queryParams' => array_filter($data)]);

        $products = $this->getRepository()->paginate($quantity,$page, $filter);
        $products = IndexResource::collection($products);
        $products->setPath($path);
        return $products;
    }

    public function findById(int $id): Model|null
    {
        return $this->getRepository()->findById($id);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $this->storeImages($data['images']);
        $images = $data['images'];
        $tags = $data['tag_ids'];
        $colors = $data['color_ids'];
        unset($data['images'], $data['tag_ids'], $data['color_ids']);
        $this->getRepository()->store($data, $images, $tags, $colors);
    }

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void
    {
        $product = $this->getRepository()->findById($id);
        if (isset($data['images'])) {
            $images = $product->images;
            foreach ($images as $image) {
                $this->destroyImage($image->id);
            }
            $this->storeImages($data['images']);
            $images = $data['images'];
            $product->images()->sync($images);
        }
        $tags = $data['tag_ids'];
        $colors = $data['color_ids'];
        unset($data['images'], $data['tag_ids'], $data['color_ids']);
        $product->tags()->sync($tags);
        $product->colors()->sync($colors);
        $this->getRepository()->update($id, $data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $images = $this->getRepository()->findById($id)->images;
        foreach ($images as $image) {
            $this->destroyImage($image->id);
        }
        $this->getRepository()->destroy($id);
    }

    /**
     * @return Collection
     */
    public function getAllCategories(): Collection
    {
        return $this->getCategoryRepository()->getAll();
    }

    /**
     * @return Collection
     */
    public function getAllColors(): Collection
    {
        return $this->getColorRepository()->getAll();
    }

    /**
     * @return Collection
     */
    public function getAllTags(): Collection
    {
        return $this->getTagRepository()->getAll();
    }

    /**
     * @return ProductRepositoryProxyContract
     */
    public function getRepository(): ProductRepositoryProxyContract
    {
        return $this->repository;
    }

    /**
     * @return ImageRepositoryProxyContract
     */
    public function getImageRepository(): ImageRepositoryProxyContract
    {
        return $this->imageRepository;
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
