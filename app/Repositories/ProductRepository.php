<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Http\Filters\ProductFilter;
use App\Models\Product as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class ProductRepository
 *
 * @package App\Repositories
 */
class ProductRepository extends CoreRepository implements ProductRepositoryContract
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param int $quantity
     * @param int $page
     * @param ProductFilter $filter
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity, int $page, ProductFilter $filter): LengthAwarePaginator
    {
        return $this->startConditions()
            ->filter($filter)
            ->paginate($quantity, ['*'], 'page', $page);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null
    {
        return $this->startConditions()
            ->find($id);
    }

    /**
     * @param string $title
     * @return Model|null
     */
    public function findByTitle(string $title): Model|null
    {
        return $this->startConditions()
            ->where('title', '=', $title)
            ->first();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        return $this->startConditions()
            ->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        return $this->startConditions()
            ->find($id)
            ->update($data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $this->startConditions()
            ->find($id)
            ->delete();
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->startConditions()
            ->all()
            ->count();
    }

    public function getAll(): Collection
    {
        return $this->startConditions()->all();
    }


    public function getMinPrice(): float
    {
        return $this->startConditions()->min('price');
    }

    public function getMaxPrice(): float
    {
        return $this->startConditions()->max('price');
    }

    public function getRecentProducts(int $count = 5): Collection
    {
        return $this->startConditions()->latest('created_at')->take($count)->get();
    }
}
