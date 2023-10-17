<?php

namespace App\Contracts\Repositories\Proxy;

use App\Models\ProductUserOrder;

interface ProductUserOrderRepositoryProxyContract
{
    /**
     * @param array $data
     * @return ProductUserOrder
     */
    public function store(array $data): \App\Models\ProductUserOrder;
}
