<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\ImageRepositoryContract;
use App\Contracts\Repositories\ProductRepositoryContract;
use App\Contracts\Services\ProductServiceContract;
use App\Http\Resources\Client\Admin\Product\IndexResource;
use App\Services\Traits\DataCachingTrait;
use App\Services\Traits\StorageTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ProductService extends CoreService implements ProductServiceContract
{
    use StorageTrait, DataCachingTrait;

    public function __construct(
        private readonly ProductRepositoryContract $repository,
        private readonly ImageRepositoryContract $imageRepository,
    )
    {
        parent::__construct();
    }

    /**
     * @param int $quantity
     * @param int $page
     * @param string $path
     * @return AnonymousResourceCollection
     */
    public function paginate(int $quantity, int $page, string $path): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $products = Cache::rememberForever("products:paginate:$page", function () use ($quantity, $page) {
            return $this->getRepository()->paginate($quantity, $page);
        });

        if ($products->items() === []) {
            abort(404);
        }

        $products = IndexResource::collection($products);
        $products->setPath($path);
        return $products;
    }

    public function findById(int $id): Model|null
    {
        return Cache::get("products:$id");
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
        $product = $this->getRepository()->store($data);
        $product->images()->attach($images);
        $product->tags()->attach($tags);
        $product->colors()->attach($colors);
        $products = $this->getRepository()->getAll();

        Cache::put("products:$product->id", $product);
        Cache::put("products:all", $products);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'products');
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
        $product = $this->getRepository()->findById($id);
        $products = $this->getRepository()->getAll();

        Cache::put("products:$id", $product);
        Cache::put("products:all", $products);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'products');
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
        Cache::forget("products:$id");

        $products = $this->getRepository()->getAll();
        Cache::put("products:all", $products);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'products');
    }

    /**
     * @return Collection
     */
    public function getAllCategories(): Collection
    {
        return Cache::get("categories:all");
    }

    /**
     * @return Collection
     */
    public function getAllColors(): Collection
    {
        return Cache::get("colors:all");
    }

    /**
     * @return Collection
     */
    public function getAllTags(): Collection
    {
        return Cache::get("tags:all");
    }

    /**
     * @return ProductRepositoryContract
     */
    public function getRepository(): ProductRepositoryContract
    {
        return $this->repository;
    }

    /**
     * @return ImageRepositoryContract
     */
    public function getImageRepository(): ImageRepositoryContract
    {
        return $this->imageRepository;
    }
}
