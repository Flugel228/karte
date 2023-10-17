<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Contracts\Repositories\TagRepositoryContract;
use App\Models\Color;
use Illuminate\Support\Facades\Cache;

class TagDeleteStrategy extends AbstractStrategy
{
    private readonly TagRepositoryContract $repository;

    public function __construct()
    {
        $this->repository = app(TagRepositoryContract::class);
    }

    public function cache(int $id, mixed $additional): void
    {
        $this->cacheOne($id);
        $this->getRepository()->destroy($id);
        $this->cacheAll();
        $this->cachePaginate();
    }

    protected function cacheAll(): void
    {
        $tags = $this->getRepository()->getAll();
        Cache::put("tags:all", $tags);
    }

    protected function cacheOne(int $id): void
    {
        $tag = $this->getRepository()->findById($id);
        Cache::forget("tags:$id", $tag);
        Cache::forget("tags:$tag->title", $tag);
    }

    protected function cachePaginate(): void
    {
        $numberOfElements = $this->getRepository()->count();
        $quantity = 10;
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            $tags = $this->getRepository()->paginate($quantity, $page);
            Cache::put("tags:paginate:$page", $tags);
        }
    }

    /**
     * @return TagRepositoryContract
     */
    public function getRepository(): TagRepositoryContract
    {
        return $this->repository;
    }
}
