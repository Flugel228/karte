<?php

namespace App\Contracts\Repositories\Proxy;

use App\Models\Image as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ImageRepositoryProxyContract
{
    public function getAll(): Collection;

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null;

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
