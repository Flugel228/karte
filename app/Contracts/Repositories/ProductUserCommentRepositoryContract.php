<?php

namespace App\Contracts\Repositories;

use App\Models\ProductUserComment;
interface ProductUserCommentRepositoryContract
{
    /**
     * @param array $data
     * @return ProductUserComment
     */
    public function store(array $data): \App\Models\ProductUserComment;
}
