<?php

namespace App\Repositories\Proxy;

use App\Contracts\Repositories\ColorRepositoryContract;
use App\Contracts\Repositories\Proxy\ColorRepositoryProxyContract;
use App\Models\Color as Model;
use App\Strategy\Repositories\Proxy\CacheManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ColorRepositoryProxy extends CoreRepositoryProxy implements ColorRepositoryProxyContract
{

    protected function getRepositoryClass(): string
    {
        return ColorRepositoryContract::class;
    }

    public function getAll(): Collection
    {
        return Cache::rememberForever('colors:all', function () {
            return $this->startConditions()->getAll();
        });
    }

    public function paginate(int $quantity, int $page): LengthAwarePaginator
    {
        return Cache::rememberForever("colors:paginate:$page", function () use ($quantity, $page) {
            return $this->startConditions()->paginate($quantity, $page);
        });
    }

    public function findById(int $id): Model|null
    {
        return Cache::rememberForever("colors:$id", function () use ($id) {
            return $this->startConditions()->findById($id);
        });

    }

    public function findByTitle(string $title): Model|null
    {
        return Cache::rememberForever("colors:$title", function () use ($title) {
            return $this->startConditions()->findByTitle($title);
        });
    }

    public function findByCode(string $code): Model|null
    {
        return Cache::rememberForever("colors:code:$code", function () use ($code) {
            return $this->startConditions()->findByCode($code);
        });
    }

    public function store(array $data): Model
    {
        $result = $this->startConditions()->store($data);
        (new CacheManager('Color', $result->id))->handle();
        return $result;
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->startConditions()->update($id, $data);
        (new CacheManager('Color', $id))->handle();
        return $result;
    }

    public function destroy(int $id): void
    {
        (new CacheManager('ColorDelete', $id))->handle();
    }
}
