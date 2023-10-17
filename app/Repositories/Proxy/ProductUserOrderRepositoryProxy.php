<?php

namespace App\Repositories\Proxy;

use App\Contracts\Repositories\ProductUserOrderRepositoryContract;
use App\Contracts\Repositories\Proxy\ProductUserOrderRepositoryProxyContract;

class ProductUserOrderRepositoryProxy extends CoreRepositoryProxy implements ProductUserOrderRepositoryProxyContract
{

    protected function getRepositoryClass(): string
    {
        return ProductUserOrderRepositoryContract::class;
    }

    public function store(array $data): \App\Models\ProductUserOrder
    {
        return $this->startConditions()->store($data);
    }
}
