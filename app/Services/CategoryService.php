<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\Proxy\CategoryRepositoryProxyContract;
use App\Contracts\Services\CategoryServiceContract;
use App\Http\Resources\Client\Admin\Category\IndexResource;
use App\Services\Traits\DataCachingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService extends CoreService implements CategoryServiceContract
{
    use DataCachingTrait;

    public function __construct(
        private readonly CategoryRepositoryProxyContract $repository,
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
        $categories = $this->getRepository()->paginate($quantity, $page);
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
        $category = $this->getRepository()->findByTitle($data['title']);
        if ($category === null or $category->id === $id) {
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
     * @return CategoryRepositoryProxyContract
     */
    public function getRepository(): CategoryRepositoryProxyContract
    {
        return $this->repository;
    }
}
