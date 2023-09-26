<?php

namespace App\Contracts\Services;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface OrderServiceContract
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection;

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void;
}
