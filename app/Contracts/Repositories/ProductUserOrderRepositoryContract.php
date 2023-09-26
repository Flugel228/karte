<?php

namespace App\Contracts\Repositories;

use App\Http\Filters\ProductUserOrderFilter;
use App\Models\ProductUserOrder;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductUserOrderRepositoryContract
{

    /**
     * @param array $filter
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity, int $page, ProductUserOrderFilter $filter): LengthAwarePaginator;

    /**
     * @param array $data
     * @return ProductUserOrder
     */
    public function store(array $data): \App\Models\ProductUserOrder;
}
