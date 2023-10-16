<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Contracts\Repositories\ImageRepositoryContract;
use App\Models\Color;
use Illuminate\Support\Facades\Cache;

class ImageDeleteStrategy extends AbstractStrategy
{
    private readonly ImageRepositoryContract $repository;

    public function __construct()
    {
        $this->repository = app(ImageRepositoryContract::class);
    }

    public function cache(int $id, mixed $additional): void
    {
        $this->cacheOne($id);
        $this->getRepository()->destroy($id);
        $this->cacheAll();
    }

    protected function cacheAll(): void
    {
        $images = $this->getRepository()->getAll();
        Cache::put("images:all", $images);
    }

    protected function cacheOne(int $id): void
    {
        Cache::forget("images:$id");
    }

    /**
     * @return ImageRepositoryContract
     */
    public function getRepository(): ImageRepositoryContract
    {
        return $this->repository;
    }
}
