<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Interfaces;

interface CacheStrategyInterface
{
    public function cache(int $id, mixed $additional): void;
}
