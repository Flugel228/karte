<?php declare(strict_types=1);

namespace App\Strategy\Repositories\Proxy\Strategies;

use App\Contracts\Repositories\ImageRepositoryContract;
use Illuminate\Support\Facades\Cache;

class ImageStrategy extends AbstractStrategy
{
    private readonly ImageRepositoryContract $repository;

    public function __construct()
    {
        $this->repository = app(ImageRepositoryContract::class);
    }

    public function cache(int $id, mixed $additional): void
    {
        $this->cacheAll();
        $this->cacheOne($id);

    }

    protected function cacheAll(): void
    {
        $images = $this->getRepository()->getAll();
        Cache::put("images:all", $images);
    }

    protected function cacheOne(int $id): void
    {
        $image = $this->getRepository()->findById($id);
        Cache::put("images:$id", $image);
    }

    /**
     * @return ImageRepositoryContract
     */
    public function getRepository(): ImageRepositoryContract
    {
        return $this->repository;
    }
}
