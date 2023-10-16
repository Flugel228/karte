<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Contracts\Repositories\ColorRepositoryContract;
use App\Models\Color;
use Illuminate\Support\Facades\Cache;

class ColorStrategy extends AbstractStrategy
{
    private readonly ColorRepositoryContract $repository;

    public function __construct()
    {
        $this->repository = app(ColorRepositoryContract::class);
    }

    public function cache(int $id, mixed $additional): void
    {
        $this->cacheAll();

        $this->cacheOne($id);

        $this->cachePaginate();
    }

    protected function cacheAll(): void
    {
        $colors = $this->getRepository()->getAll();
        Cache::put("colors:all", $colors);
    }

    protected function cacheOne(int $id): void
    {
        $color = $this->getRepository()->findById($id);
        Cache::put("colors:$id", $color);
        Cache::put("colors:$color->title", $color);
        Cache::put("colors:code:$color->code", $color);
    }

    protected function cachePaginate(): void
    {
        $numberOfElements = $this->getRepository()->count();
        $quantity = 10;
        $numberOfPages = $numberOfElements % $quantity !== 0 ? intdiv($numberOfElements, $quantity) + 1 : $numberOfElements / $quantity;
        for ($page = 1; $page <= $numberOfPages; $page++) {
            $colors = $this->getRepository()->paginate($quantity, $page);
            Cache::put("colors:paginate:$page", $colors);
        }
    }

    /**
     * @return ColorRepositoryContract
     */
    public function getRepository(): ColorRepositoryContract
    {
        return $this->repository;
    }
}
