<?php declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Contracts\Services\UserServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Like\StoreRequest;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LikeController extends BaseController
{
    public function __construct(
        private readonly UserServiceContract $service,
    )
    {
        parent::__construct();
    }

    /**
     * @param StoreRequest $request
     * @return void
     */
    public function store(StoreRequest $request): void
    {
        $data = $request->validated();
        $this->getService()->likeProduct($data);
    }

    /**
     * @return UserServiceContract
     */
    public function getService(): UserServiceContract
    {
        return $this->service;
    }
}
