<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\Color;
use Illuminate\Support\Facades\Cache;

class UserStrategy extends AbstractStrategy
{
    private readonly UserRepositoryContract $repository;

    public function __construct()
    {
        $this->repository = app(UserRepositoryContract::class);
    }

    public function cache(int $id, mixed $additional): void
    {
        $this->cacheAll();

        $this->cacheOne($id);

        $this->cachePaginate();
    }

    protected function cacheAll(): void
    {
        $users = $this->getRepository()->getAll();
        Cache::put("users:all", $users);
    }

    protected function cacheOne(int $id): void
    {
        $user = $this->getRepository()->findById($id);
        Cache::put("users:$id", $user);
        Cache::put("users:$user->title", $user);
        Cache::put("users:code:$user->code", $user);
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

    /**
     * @return UserRepositoryContract
     */
    public function getRepository(): UserRepositoryContract
    {
        return $this->repository;
    }
}
