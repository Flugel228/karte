<?php

namespace App\Contracts\Repositories;

use App\Models\User as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryContract
{

    /**
     * @param int $quantity
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model;

    /**
     * @param int $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;
}
