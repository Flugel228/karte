<?php

namespace App\Repositories\Proxy;

use App\Contracts\Repositories\ImageRepositoryContract;
use App\Contracts\Repositories\Proxy\ImageRepositoryProxyContract;
use App\Models\Image as Model;
use App\Strategy\Repositories\Proxy\CacheManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class ImageRepositoryProxy extends CoreRepositoryProxy implements ImageRepositoryProxyContract
{

    protected function getRepositoryClass(): string
    {
        return ImageRepositoryContract::class;
    }

    public function getAll(): Collection
    {
        return Cache::rememberForever("images:all", function () {
            return $this->startConditions()->getAll();
        });
    }

    public function findById(int $id): Model|null
    {
        return Cache::rememberForever("images:$id", function () use ($id) {
            return $this->startConditions()->findById($id);
        });
    }

    public function store(array $data): Model
    {
        $result = $this->startConditions()->store($data);
        (new CacheManager('Image', $result->id))->handle();
        return $result;
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->startConditions()->update($id, $data);
        (new CacheManager('Image', $id))->handle();
        return $result;
    }

    public function destroy(int $id): void
    {
        (new CacheManager('ImageDelete', $id))->handle();
    }
}
