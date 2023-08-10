<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ColorRepositoryContract;
use App\Models\Color as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class ColorRepository extends CoreRepository implements ColorRepositoryContract, CountableRepository
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param int $quantity
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity, int $page): LengthAwarePaginator
    {
        return $this->startConditions()->paginate($quantity, ['*'], 'page', $page);
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
     * @param string $title
     * @return Model|null
     */
    public function findByTitle(string $title): Model|null
    {
        return $this->startConditions()->where('title', '=', $title)->first();
    }

    /**
     * @param string $code
     * @return Model|null
     */
    public function findByCode(string $code): Model|null
    {
        return $this->startConditions()->where('code', '=', $code)->first();
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

    public function count(): int
    {
        return $this->startConditions()->all()->count();
    }

    public function getAll(): Collection
    {
        return $this->startConditions()->all();
    }
}
