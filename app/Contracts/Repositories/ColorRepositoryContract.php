<?php

namespace App\Contracts\Repositories;

use App\Models\Color as Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ColorRepositoryContract
{

    /**
     * @param int $quantity
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity): LengthAwarePaginator;

    /**
     * @param string $title
     * @return Model|null
     */
    public function findByTitle(string $title): Model|null;

    /**
     * @param string $code
     * @return Model|null
     */
    public function findByCode(string $code): Model|null;

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
