<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\Color;
use Illuminate\Support\Facades\Cache;

class UserDeleteStrategy extends AbstractStrategy
{
    private readonly UserRepositoryContract $repository;

    public function __construct()
    {
        $this->repository = app(UserRepositoryContract::class);
    }

    public function cache(int $id, mixed $additional): void
    {
        $this->cacheOne($id);
        $this->getRepository()->destroy($id);
        $this->cacheAll();
        $this->cachePaginate();
        $this->forgetLikedProducts($id);
        $this->forgetOrderedProducts($id);
    }

    protected function cacheAll(): void
    {
        $users = $this->getRepository()->getAll();
        Cache::put("users:all", $users);
    }

    protected function cacheOne(int $id): void
    {
        $user = $this->getRepository()->findById($id);
        Cache::forget("users:$id");
        Cache::forget("users:$user->title");
        Cache::forget("users:code:$user->code");
    }

    protected function cachePaginate(): void
    {
        $numberOfElements = $this->getRepository()->count();
        $quantity = 10;
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            $users = $this->getRepository()->paginate($quantity, $page);
            Cache::put("users:paginate:$page", $users);
        }
    }

    private function forgetLikedProducts(int $id): void
    {
        Cache::forget("users:$id:likedProducts");
    }

    private function forgetOrderedProducts(int $id): void
    {
        Cache::forget("users:$id:orderedProducts");
    }

    /**
     * @return UserRepositoryContract
     */
    public function getRepository(): UserRepositoryContract
    {
        return $this->repository;
    }
}
