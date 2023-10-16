<?php

namespace App\Repositories\Proxy;

use App\Contracts\Repositories\Proxy\TagRepositoryProxyContract;
use App\Contracts\Repositories\TagRepositoryContract;
use App\Models\Tag as Model;
use App\Strategy\Repositories\Proxy\CacheManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class TagRepositoryProxy extends CoreRepositoryProxy implements TagRepositoryProxyContract
{

    protected function getRepositoryClass(): string
    {
        return TagRepositoryContract::class;
    }

    public function getAll(): Collection
    {
        return Cache::rememberForever('tags:all', function () {
            return $this->startConditions()->getAll();
        });
    }

    public function paginate(int $quantity, int $page): LengthAwarePaginator
    {
        return Cache::rememberForever("tags:paginate:$page", function () use ($quantity, $page) {
            return $this->startConditions()->paginate($quantity, $page);
        });
    }

    public function findById(int $id): Model|null
    {
        return Cache::rememberForever("tags:$id", function () use ($id) {
            return $this->startConditions()->findById($id);
        });
    }

    public function findByTitle(string $title): Model|null
    {
        return Cache::rememberForever("users:$title", function () use ($title) {
            return $this->startConditions()->findByTitle($title);
        });
    }

    public function store(array $data): Model
    {
        $result = $this->startConditions()->store($data);
        (new CacheManager('Tag', $result->id))->handle();
        return $result;
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->startConditions()->update($id, $data);
        (new CacheManager('Tag', $id))->handle();
        return $result;
    }

    public function destroy(int $id): void
    {
        (new CacheManager('TagDelete', $id))->handle();
    }
}
