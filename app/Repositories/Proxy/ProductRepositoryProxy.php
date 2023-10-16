<?php declare(strict_types=1);

namespace App\Repositories\Proxy;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Contracts\Repositories\Proxy\ProductRepositoryProxyContract;
use App\Http\Filters\ProductFilter;
use App\Models\Product as Model;
use App\Strategy\Repositories\Proxy\CacheManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ProductRepositoryProxy extends CoreRepositoryProxy implements ProductRepositoryProxyContract
{

    protected function getRepositoryClass(): string
    {
        return ProductRepositoryContract::class;
    }

    public function getAll(): Collection
    {
        return Cache::rememberForever("products:all", function () {
            return $this->startConditions()->getAll();
        });
    }

    public function paginate(int $quantity, int $page, ProductFilter $filter, bool $flag = false): LengthAwarePaginator
    {
        if ($flag) {
            return $this->startConditions()->paginate($quantity, $page, $filter);
        }
        return Cache::rememberForever("products:paginate:$page", function () use ($quantity, $page, $filter) {
            return $this->startConditions()->paginate($quantity, $page, $filter);
        });
    }

    public function findById(int $id)
    {
        return Cache::rememberForever("products:$id", function () use ($id) {
            return $this->startConditions()->findById($id);
        });
    }

    public function findByTitle(string $title): Model|null
    {
        return Cache::rememberForever("products:$title", function () use ($title) {
            return $this->startConditions()->findByTitle($title);
        });
    }

    public function store(array $data, array $images, array $tags, array $colors): Model
    {
        $result = $this->startConditions()->store($data);
        (new CacheManager('Product', $result->id))->handle();
        $result->images()->attach($images);
        $result->tags()->attach($tags);
        $result->colors()->attach($colors);
        return $result;
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->startConditions()->update($id, $data);
        (new CacheManager('Product', $id))->handle();
        return $result;
    }

    public function destroy(int $id): void
    {
        (new CacheManager('ProductDelete', $id))->handle();
    }

    public function getMinPrice(): float
    {
        return (float)Cache::rememberForever("products:minPrice", function () {
            return $this->startConditions()->getMinPrice();
        });
    }

    public function getMaxPrice(): float
    {
        return (float)Cache::rememberForever("products:maxPrice", function () {
            return $this->startConditions()->getMaxPrice();
        });
    }

    public function getRecentProducts(int $count = 5): Collection
    {
        return Cache::rememberForever("products:recentProducts", function () use ($count) {
            return $this->startConditions()->getRecentProducts($count);
        });
    }
}
