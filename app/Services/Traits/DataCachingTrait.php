<?php declare(strict_types=1);

namespace App\Services\Traits;

use App\Repositories\CountableRepository;
use Illuminate\Support\Facades\Cache;

trait DataCachingTrait
{
    private function paginationCacheUpdateHandler(CountableRepository $repository, string $table, int $quantity): void
    {
        $numberOfElements = $repository->count();
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page ++)
        {
            Cache::put("$table:paginate:$page", $repository->paginate($quantity, $page));
        }
    }
}
