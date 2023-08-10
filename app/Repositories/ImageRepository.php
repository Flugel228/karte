<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ImageRepositoryContract;
use App\Models\Image as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class ImageRepository
 *
 * @package App\Repositories
 */
class ImageRepository extends CoreRepository implements ImageRepositoryContract
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null
    {
        return $this->startConditions()->find($id);
    }

    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        return $this->startConditions()->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->startConditions()->find($id)->update($data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->startConditions()->find($id)->delete();
    }

    public function getAll(): Collection
    {
        return $this->startConditions()->all();
    }

}
