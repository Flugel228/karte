<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\ColorRepositoryContract;
use App\Contracts\Services\ColorServiceContract;
use App\Http\Resources\Client\Admin\Color\IndexResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ColorService extends CoreService implements ColorServiceContract
{

    public function __construct(
        private readonly ColorRepositoryContract $repository,
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
}
