<?php

namespace App\Contracts\Repositories;

use App\Models\User as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryContract
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
     * @return int
     */
    public function count(): int;
}
