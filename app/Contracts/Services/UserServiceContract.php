<?php

namespace App\Contracts\Services;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface UserServiceContract
{

    /**
     * @param int $quantity
     * @return AnonymousResourceCollection
     */
    public function paginate(int $quantity): \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void;

    /**
     * @param int $id
     * @param array $data
     * @return void
     */
    public function update(int $id, array $data): void;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;
}
