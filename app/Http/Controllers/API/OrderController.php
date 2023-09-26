<?php declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Contracts\Services\OrderServiceContract;
use App\Http\Controllers\BaseController;
use App\Http\Requests\API\Order\StoreRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends BaseController
{
    public function __construct(
        private readonly OrderServiceContract $service,
    )
    {
        parent::__construct();
    }


    public function index(): AnonymousResourceCollection
    {
        return $this->getService()->index();
    }

    /**
     * @param StoreRequest $request
     * @return void
     */
    public function store(StoreRequest $request): void
    {
        $data = $request->validated();
        $this->getService()->store($data);
    }

    /**
     * @return OrderServiceContract
     */
    public function getService(): OrderServiceContract
    {
        return $this->service;
    }
}
