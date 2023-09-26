<?php

namespace App\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface UserServiceContract
{

    /**
     * @param int $quantity
     * @param int $page
     * @param string $path
     * @return AnonymousResourceCollection
     */
    public function paginate(int $quantity, int $page, string $path): AnonymousResourceCollection;

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

    /**
     * @return array
     */
    public function getGenders(): array;

    /**
     * @return AnonymousResourceCollection
     */
    public function getLikedProducts(): AnonymousResourceCollection;

    /**
     * @param array $data
     * @return void
     */
    public function likeProduct(array $data): void;

    /**
     * @param array $data
     * @return void
     */
    public function commentProduct(array $data): void;
}
