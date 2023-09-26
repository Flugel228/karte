<?php declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Contracts\Services\ShopServiceContract;
use App\Contracts\Services\UserServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Shop\ProductRequest;
use App\Http\Requests\API\User\StoreRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class UserController extends BaseController
{
    public function __construct(
        private readonly UserServiceContract $service,
    )
    {
        parent::__construct();
    }

    /**
     * @param StoreRequest $request
     * @return Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
     */
    public function store(StoreRequest $request): Application|Response|\Illuminate\Contracts\Foundation\Application|ResponseFactory
    {
        $data = $request->validated();
        $this->getService()->store($data);
        return response([
            'message' => 'Пользователь создан.'
        ],200);
    }


    /**
     * @return JsonResponse
     */
    public function genders(): JsonResponse
    {
        return response()->json([
            'data' => $this->getService()->getGenders()
        ]);
    }

    public function wishlist(): JsonResponse
    {
        $products = $this->getService()->getLikedProducts();
        return response()->json($products);

    }

    /**
     * @return UserServiceContract
     */
    public function getService(): UserServiceContract
    {
        return $this->service;
    }
}
