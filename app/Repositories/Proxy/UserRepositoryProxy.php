<?php

namespace App\Repositories\Proxy;

use App\Contracts\Repositories\Proxy\UserRepositoryProxyContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User as Model;
use App\Strategy\Repositories\Proxy\CacheManager;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class UserRepositoryProxy extends CoreRepositoryProxy implements UserRepositoryProxyContract
{

    protected function getRepositoryClass(): string
    {
        return UserRepositoryContract::class;
    }

    public function getAll(): Collection
    {
        return Cache::rememberForever('users:all', function () {
            return $this->startConditions()->getAll();
        });
    }

    public function paginate(int $quantity, int $page): LengthAwarePaginator
    {
        return Cache::rememberForever("users:paginate:$page", function () use ($quantity, $page) {
            return $this->startConditions()->paginate($quantity, $page);
        });
    }

    public function findById(int $id): Model|null
    {
        return Cache::rememberForever("users:$id", function () use ($id) {
            return $this->startConditions()->findById($id);
        });
    }

    public function findByEmail(string $email): Model|null
    {
        return Cache::rememberForever("users:email:$email", function () use ($email) {
            return $this->startConditions()->findByEmail($email);
        });
    }

    public function store(array $data): Model
    {
        $result = $this->startConditions()->store($data);
        (new CacheManager('User', $result->id))->handle();
        return $result;
    }

    public function update(int $id, array $data): bool
    {
        $result = $this->startConditions()->update($id, $data);
        (new CacheManager('User', $id))->handle();
        return $result;
    }

    public function destroy(int $id): void
    {
        (new CacheManager('UserDelete', $id))->handle();
    }


    public function getGenders(): array
    {
        return Cache::rememberForever("users:genders", function () {
            return $this->startConditions()->getGenders();
        });
    }

    public function getLikedProducts(int $id): Collection
    {
        return Cache::rememberForever("users:$id:likedProducts", function () use ($id) {
            return $this->startConditions()->getLikedProducts($id);
        });
    }

    public function likeProduct(array $data): void
    {
        $this->startConditions()->likeProduct($data);
        $products = $this->startConditions()->getLikedProducts($data['user_id']);
        Cache::put("users:{$data['user_id']}:likedProducts", $products);
    }

    public function toOrderProduct(array $data): void
    {
        $this->startConditions()->toOrderProduct($data);
        $products = $this->startConditions()->getOrderedProducts($data['user_id']);
        Cache::put("users:{$data['user_id']}:orderedProducts", $products);
    }

    public function getOrderedProducts(int $id): Collection
    {
        return Cache::rememberForever("users:$id:orderedProducts", function () use ($id) {
            return $this->startConditions()->getOrderedProducts($id);
        });
    }
}
