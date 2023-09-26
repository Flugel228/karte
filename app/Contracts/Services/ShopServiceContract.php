<?php

namespace App\Contracts\Services;

use App\Http\Resources\API\Shop\SingleProductResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

interface ShopServiceContract
{
    /**
     * @param int $quantity
     * @param array $data
     * @return AnonymousResourceCollection
     */
    public function paginate(int $quantity, array $data): \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

    /**
     * @return AnonymousResourceCollection
     */
    public function getCategories(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

    /**
     * @return AnonymousResourceCollection
     */
    public function getColors(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

    /**
     * @return AnonymousResourceCollection
     */
    public function getTags(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

    /**
     * @return array
     */
    public function getPrices(): array;

    /**
     * @param int $id
     * @return SingleProductResource
     */
    public function getProduct(int $id): SingleProductResource;
}
