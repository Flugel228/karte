<?php

namespace App\Contracts\Repositories\Proxy;

use App\Models\ProductUserComment;
interface ProductUserCommentRepositoryProxyContract
{
    /**
     * @param array $data
     * @return ProductUserComment
     */
    public function store(array $data): \App\Models\ProductUserComment;
}
