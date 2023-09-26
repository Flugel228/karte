<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\TagRepositoryContract;
use App\Contracts\Services\TagServiceContract;
use App\Http\Resources\Client\Admin\Tag\IndexResource;
use App\Services\Traits\DataCachingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class TagService extends CoreService implements TagServiceContract
{
    use DataCachingTrait;

    public function __construct(
        private readonly TagRepositoryContract $repository,
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
        $tags = Cache::rememberForever("tags:paginate:$page", function () use ($quantity, $page) {
            return $this->getRepository()->paginate($quantity, $page);
        });

        if ($tags->items() === []) {
            abort(404);
        }

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
        return Cache::get("tags:$id");
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $data['title'] = ucfirst($data['title']);
        $tag = $this->getRepository()->store($data);
        $tags = $this->getRepository()->getAll();

        Cache::put("tags:$tag->id", $tag);
        Cache::put("tags:all", $tags);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'tags', 10);
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
            $tag = $this->getRepository()->findById($id);
            $tags = $this->getRepository()->getAll();

            Cache::put("tags:$id", $tag);
            Cache::put("tags:all", $tags);

            $this->paginationCacheUpdateHandler($this->getRepository(), 'tags', 10);
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
        Cache::forget("tags:$id");

        $tags = $this->getRepository()->getAll();
        Cache::put("tags:all", $tags);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'tags', 10);
    }

    /**
     * @return TagRepositoryContract
     */
    public function getRepository(): TagRepositoryContract
    {
        return $this->repository;
    }
}
