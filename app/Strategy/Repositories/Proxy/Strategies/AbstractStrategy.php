<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Strategy\Repositories\Proxy\Interfaces\CacheStrategyInterface;

abstract class AbstractStrategy implements CacheStrategyInterface
{
    public function cache(int $id, mixed $additional): void
    {
        $this->cacheAll();

        $this->cacheOne($id);

        $this->cachePaginate();
    }

    protected function cacheAll(): void
    {
    }

    protected function cacheOne(int $id): void
    {
    }

    protected function cachePaginate(): void
    {
    }
}
