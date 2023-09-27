<?php

namespace App\Contracts\Repositories;

use App\Models\ProductUserOrder;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductUserOrderRepositoryContract
{
    /**
     * @param array $data
     * @return ProductUserOrder
     */
    public function store(array $data): \App\Models\ProductUserOrder;
}
