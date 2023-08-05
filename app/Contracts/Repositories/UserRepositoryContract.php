<?php

namespace App\Contracts\Repositories;

use App\Models\User as Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryContract
{

    /**
     * @param int $quantity
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity): LengthAwarePaginator;

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
}
