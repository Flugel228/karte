<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Contracts\Repositories\CategoryRepositoryContract;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryDeleteStrategy extends AbstractStrategy
{
    private readonly CategoryRepositoryContract $repository;

    public function __construct()
    {
        $this->repository = app(CategoryRepositoryContract::class);
    }

    public function cache(int $id, mixed $additional): void
    {
        $this->cacheOne($id);
        $this->getRepository()->destroy($id);
        $this->cacheAll();
        $this->cachePaginate();
    }

    protected function cacheAll(): void
    {
        $categories = $this->getRepository()->getAll();
        Cache::put("categories:all", $categories);
    }

    protected function cacheOne(int $id): void
    {
        $category = $this->getRepository()->findById($id);
        Cache::forget("categories:$id");
        Cache::forget("categories:$category->title");
    }

    protected function cachePaginate(): void
    {
        $numberOfElements = $this->getRepository()->count();
        $quantity = 10;
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            $categories = $this->getRepository()->paginate($quantity, $page);
            Cache::put("categories:paginate:$page", $categories);
        }
    }

    /**
     * @return CategoryRepositoryContract
     */
    public function getRepository(): CategoryRepositoryContract
    {
        return $this->repository;
    }
}
