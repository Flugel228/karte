<?php declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Contracts\Services\ShopServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Shop\ProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ShopController extends BaseController
{
    public function __construct(
        private readonly ShopServiceContract $service,
    )
    {
        parent::__construct();
    }

    /**
     * @param ProductRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(ProductRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validated();
        $quantity = 12;
        return $this->getService()->paginate($quantity, $data);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function categories(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return $this->getService()->getCategories();
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function colors(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return $this->getService()->getColors();
    }

    public function prices(): array
    {
        return $this->getService()->getPrices();
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function tags(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return $this->getService()->getTags();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        $product = $this->getService()->getProduct($id);
        return response()->json(['data' => $product]);
    }

    public function recentProducts(): JsonResponse
    {
        $products = $this->getService()->getRecentProducts();
        return response()->json(['data' => $products]);
    }

    /**
     * @return ShopServiceContract
     */
    public function getService(): ShopServiceContract
    {
        return $this->service;
    }
}
