<?php

namespace App\Contracts\Repositories\Proxy;

use App\Contracts\Repositories\CountableRepository;
use App\Http\Filters\ProductFilter;
use App\Models\Product as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryProxyContract
{
    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param int $quantity
     * @param int $page
     * @param ProductFilter $filter
     * @param bool $flag
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity, int $page, ProductFilter $filter, bool $flag = false): LengthAwarePaginator;

    /**
     * @param int $id
     */
    public function findById(int $id);

    /**
     * @param string $title
     * @return Model|null
     */
    public function findByTitle(string $title): Model|null;

    /**
     * @param array $data
     * @param array $images
     * @param array $tags
     * @param array $colors
     * @return Model
     */
    public function store(array $data, array $images, array $tags, array $colors): Model;

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
     * @return float
     */
    public function getMinPrice(): float;

    /**
     * @return float
     */
    public function getMaxPrice(): float;

    /**
     * @param int $count
     * @return Collection
     */
    public function getRecentProducts(int $count = 5): Collection;
}
