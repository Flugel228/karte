<?php declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Contracts\Services\UserServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Comment\StoreRequest;

class CommentController extends BaseController
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
        $this->getService()->commentProduct($data);
    }

    /**
     * @return UserServiceContract
     */
    public function getService(): UserServiceContract
    {
        return $this->service;
    }
}
