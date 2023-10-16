<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\Proxy\TagRepositoryProxyContract;
use App\Contracts\Services\TagServiceContract;
use App\Http\Resources\Client\Admin\Tag\IndexResource;
use App\Services\Traits\DataCachingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TagService extends CoreService implements TagServiceContract
{
    use DataCachingTrait;

    public function __construct(
        private readonly TagRepositoryProxyContract $repository,
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
        $tags = $this->getRepository()->paginate($quantity, $page);
        $tags = IndexResource::collection($tags);
        $tags->setPath($path);
        return $tags;
    }

    /**
     * @param int $id
     * @return Model|null
     */
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
        $tag = $this->getRepository()->findByTitle($data['title']);
        if ($tag === null or $tag->id === $id) {
            $this->getRepository()->update($id, $data);
            return null;
        }
        return 'title';
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->getRepository()->destroy($id);
    }

    /**
     * @return TagRepositoryProxyContract
     */
    public function getRepository(): TagRepositoryProxyContract
    {
        return $this->repository;
    }
}
