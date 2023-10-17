<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Http\Filters\ProductFilter;
use Illuminate\Support\Facades\Cache;

class ProductDeleteStrategy extends AbstractStrategy
{
    private readonly ProductRepositoryContract $repository;

    public function __construct()
    {
        $this->repository = app(ProductRepositoryContract::class);
    }

    public function cache(int $id, mixed $additional): void
    {
        $this->cacheOne($id);
        $this->getRepository()->destroy($id);
        $this->cacheAll();
        $this->cachePaginate();
        $this->cacheCount();
        $this->cachePrices();
        $this->cacheRecentProducts();
    }

    protected function cacheAll(): void
    {
        $products = $this->getRepository()->getAll();
        Cache::put("products:all", $products);
    }

    protected function cacheOne(int $id): void
    {
        $product = $this->getRepository()->findById($id);
        Cache::forget("products:$id", $product);
        Cache::forget("products:$product->title", $product);
    }

    protected function cachePaginate(): void
    {
        $numberOfElements = $this->getRepository()->count();
        $quantity = 10;
        $data = [
            'categories' => [],
            'colors' => [],
            'tags' => [],
            'prices' => [],
            'title' => [],
        ];
        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            $products = $this->getRepository()->paginate($quantity, $page, $filter);
            Cache::put("products:paginate:$page", $products);
        }
    }

    private function cacheCount(): void
    {
        $count = $this->getRepository()->count();
        Cache::put("products:count", $count);
    }

    private function cachePrices(): void
    {
        $price = $this->getRepository()->getMinPrice();
        Cache::put("products:minPrice", $price);
        $price = $this->getRepository()->getMaxPrice();
        Cache::put("products:maxPrice", $price);
    }

    private function cacheRecentProducts(): void
    {
        $count = $this->getRepository()->count();
        $products = $count < 5 ? $this->getRepository()->getRecentProducts($count) : $this->getRepository()->getRecentProducts();
        Cache::put("products:recentProducts", $products);
    }

    /**
     * @return ProductRepositoryContract
     */
    public function getRepository(): ProductRepositoryContract
    {
        return $this->repository;
    }
}
