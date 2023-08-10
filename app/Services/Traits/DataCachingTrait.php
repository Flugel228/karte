<?php

namespace App\Services\Traits;

use App\Repositories\CountableRepository;
use Illuminate\Support\Facades\Cache;

trait DataCachingTrait
{
    private function paginationCacheUpdateHandler(CountableRepository $repository, string $table): void
    {
        $numberOfElements = $repository->count();
        $quantity = 10;
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page ++)
        {
            Cache::put("$table:paginate:$page", $repository->paginate($quantity, $page));
        }
    }
}
