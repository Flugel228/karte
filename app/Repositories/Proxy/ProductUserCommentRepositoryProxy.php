<?php

namespace App\Repositories\Proxy;

use App\Contracts\Repositories\ProductUserCommentRepositoryContract;
use App\Contracts\Repositories\Proxy\ProductUserCommentRepositoryProxyContract;

class ProductUserCommentRepositoryProxy extends CoreRepositoryProxy implements ProductUserCommentRepositoryProxyContract
{

    protected function getRepositoryClass(): string
    {
        return ProductUserCommentRepositoryContract::class;
    }

    public function store(array $data): \App\Models\ProductUserComment
    {
        return $this->startConditions()->store($data);
    }
}
