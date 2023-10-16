<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\Proxy\ProductUserOrderRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\UserRepositoryProxyContract;
use App\Contracts\Services\OrderServiceContract;
use App\Http\Resources\API\Order\IndexResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderService extends CoreService implements OrderServiceContract
{
    public function __construct(
        private readonly ProductUserOrderRepositoryProxyContract $repository,
        private readonly UserRepositoryProxyContract $userRepository
    )
    {
        parent::__construct();
    }

    public function index(): AnonymousResourceCollection
    {
        if (auth()->check()) {
            $id = auth()->user()->id;
            $products = $this->getUserRepository()->getOrderedProducts($id);
            return IndexResource::collection($products);
        }
        abort(404);
    }

    public function store(array $data): void
    {
        if (auth()->check()) {
            $storeData['user_id'] = auth()->user()->id;
            foreach ($data['product_ids'] as $product_id)
            {
                $storeData['product_id'] = $product_id;
                $this->getRepository()->store($storeData);
            }
            return;
        }
        abort(401);
    }

    /**
     * @return ProductUserOrderRepositoryProxyContract
     */
    public function getRepository(): ProductUserOrderRepositoryProxyContract
    {
        return $this->repository;
    }

    /**
     * @return UserRepositoryProxyContract
     */
    public function getUserRepository(): UserRepositoryProxyContract
    {
        return $this->userRepository;
    }
}
