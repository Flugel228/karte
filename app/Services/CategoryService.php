<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\CategoryRepositoryContract;
use App\Contracts\Services\CategoryServiceContract;
use App\Http\Resources\Client\Admin\Category\IndexResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoryService extends CoreService implements CategoryServiceContract
{

    public function __construct(
        private readonly CategoryRepositoryContract $repository,
    )
    {
        parent::__construct();
    }

    /**
     * @param int $quantity
     * @return AnonymousResourceCollection
     */
    public function paginate(int $quantity): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return IndexResource::collection($this->repository->paginate($quantity));
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $data['title'] = ucfirst($data['title']);
        $this->repository->store($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return string|null
     */
    public function update(int $id, array $data): ?string
    {
        $data['title'] = ucfirst($data['title']);
        $category = $this->repository->findByTitle($data['title']);
        if ($category === null or $category->id === $id) {
            $this->repository->update($id, $data);
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
        $this->repository->destroy($id);
    }
}
