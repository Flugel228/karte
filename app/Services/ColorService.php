<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\Proxy\ColorRepositoryProxyContract;
use App\Contracts\Services\ColorServiceContract;
use App\Http\Resources\Client\Admin\Color\IndexResource;
use App\Services\Traits\DataCachingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class ColorService extends CoreService implements ColorServiceContract
{
    use DataCachingTrait;

    public function __construct(
        private readonly ColorRepositoryProxyContract $repository,
    )
    {
        parent::__construct();
    }

    /**
     * @param int $quantity
     * @param int $page
     * @param string $path
     * @return AnonymousResourceCollection
     */
    public function paginate(int $quantity, int $page, string $path): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $colors = $this->getRepository()->paginate($quantity, $page);
        $colors = IndexResource::collection($colors);
        $colors->setPath($path);
        return $colors;
    }

    public function findById(int $id): Model|null
    {
        return $this->getRepository()->findById($id);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $data['title'] = ucfirst($data['title']);
        $this->getRepository()->store($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return string|null
     */
    public function update(int $id, array $data): ?string
    {
        $data['title'] = ucfirst($data['title']);
        $categoryByTitle = $this->repository->findByTitle($data['title']);
        $categoryByCode = $this->repository->findByCode($data['code']);
        if (
            ($categoryByTitle === null or $categoryByTitle->id === $id) and
            ($categoryByCode === null or $categoryByCode->id === $id)
        ) {
            $this->repository->update($id, $data);
            return null;
        } elseif ($categoryByTitle !== null and ($categoryByCode === null or $categoryByCode->id === $id)) {
            return 'title';
        } elseif ($categoryByCode !== null and ($categoryByTitle === null or $categoryByTitle->id === $id)) {
            return 'code';
        }
        return 'title&code';
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->repository->destroy($id);
    }

    /**
     * @return ColorRepositoryProxyContract
     */
    public function getRepository(): ColorRepositoryProxyContract
    {
        return $this->repository;
    }
}
