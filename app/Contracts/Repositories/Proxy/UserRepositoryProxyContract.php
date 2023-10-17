<?php

namespace App\Contracts\Repositories\Proxy;

use App\Models\User as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryProxyContract
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $quantity
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity, int $page): LengthAwarePaginator;

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null;

    /**
     * @param string $email
     * @return Model|null
     */
    public function findByEmail(string $email): Model|null;

    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;

    /**
     * @return array
     */
    public function getGenders(): array;

    /**
     * @param int $id
     * @return Collection
     */
    public function getLikedProducts(int $id): Collection;

    /**
     * @param array $data
     * @return void
     */
    public function likeProduct(array $data): void;

    /**
     * @param array $data
     * @return void
     */
    public function toOrderProduct(array $data): void;

    /**
     * @param int $id
     * @return Collection
     */
    public function getOrderedProducts(int $id): Collection;
}
