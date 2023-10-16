<?php

namespace App\Repositories\Proxy;

use App\Contracts\Repositories\CategoryRepositoryContract;
use App\Contracts\Repositories\Proxy\CategoryRepositoryProxyContract;
use App\Models\Category as Model;
use App\Strategy\Repositories\Proxy\CacheManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CategoryRepositoryProxy extends CoreRepositoryProxy implements CategoryRepositoryProxyContract
{

    protected function getRepositoryClass(): string
    {
        return CategoryRepositoryContract::class;
    }


    public function getAll(): Collection
    {
        return Cache::rememberForever('categories:all', function () {
            return $this->startConditions()->getAll();
        });
    }

    public function paginate(int $quantity, int $page): LengthAwarePaginator
    {
        return Cache::rememberForever("categories:paginate:$page", function () use ($quantity, $page) {
            return $this->startConditions()->paginate($quantity, $page);
        });
    }

    public function findById(int $id): Model|null
    {
        return Cache::rememberForever("categories:$id", function () use ($id) {
            return $this->startConditions()->findById($id);
        });
    }

    public function findByTitle(string $title): Model|null
    {
        return Cache::rememberForever("categories:$title", function () use ($title) {
            return $this->startConditions()->findByTitle($title);
        });
    }

    public function store(array $data): Model
    {
        $result = $this->startConditions()->store($data);
        (new CacheManager('Category', $result->id))->handle();
        return $result;
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->startConditions()->update($id, $data);
        (new CacheManager('Category', $id))->handle();
        return $result;
    }

    public function destroy(int $id): void
    {
        (new CacheManager('CategoryDelete', $id))->handle();
    }
}
