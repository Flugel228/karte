<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\CategoryRepositoryContract;
use App\Contracts\Services\CategoryServiceContract;
use App\Http\Resources\Client\Admin\Category\IndexResource;
use App\Services\Traits\DataCachingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class CategoryService extends CoreService implements CategoryServiceContract
{
    use DataCachingTrait;

    public function __construct(
        private readonly CategoryRepositoryContract $repository,
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
        $categories = Cache::rememberForever("categories:paginate:$page", function () use ($quantity, $page) {
            return $this->getRepository()->paginate($quantity, $page);
        });

        $categories = IndexResource::collection($categories);
        $categories->setPath($path);
        return $categories;
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null
    {
        return Cache::get("categories:$id");
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $data['title'] = ucfirst($data['title']);
        $category = $this->getRepository()->store($data);
        $categories = $this->getRepository()->getAll();

        Cache::put("categories:$category->id", $category);
        Cache::put("categories:all", $categories);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'categories', 10);

    }

    /**
     * @param int $id
     * @param array $data
     * @return string|null
     */
    public function update(int $id, array $data): ?string
    {
        $data['title'] = ucfirst($data['title']);
        $category = $this->getRepository()->findByTitle($data['title']);
        if ($category === null or $category->id === $id) {
            $this->getRepository()->update($id, $data);

            $category = $this->getRepository()->findById($id);
            $categories = $this->getRepository()->getAll();

            Cache::put("categories:$id", $category);
            Cache::put("categories:all", $categories);
            $this->paginationCacheUpdateHandler($this->getRepository(), 'categories', 10);
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
        Cache::forget("categories:$id");

        $categories = $this->getRepository()->getAll();
        Cache::put("categories:all", $categories);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'categories', 10);
    }

    /**
     * @return CategoryRepositoryContract
     */
    public function getRepository(): CategoryRepositoryContract
    {
        return $this->repository;
    }
}
