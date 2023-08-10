<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface TagServiceContract
{

    /**
     * @param int $quantity
     * @param int $page
     * @param string $path
     * @return AnonymousResourceCollection
     */
    public function paginate(int $quantity, int $page, string $path): \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null;

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void;

    /**
     * @param int $id
     * @param array $data
     * @return ?string
     */
    public function update(int $id, array $data): ?string;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;
}
