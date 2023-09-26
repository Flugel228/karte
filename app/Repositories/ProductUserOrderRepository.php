<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ProductUserOrderRepositoryContract;
use App\Http\Filters\ProductUserOrderFilter;
use App\Models\ProductUserOrder as Model;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class ProductRepository
 *
 * @package App\Repositories
 */
class ProductUserOrderRepository extends CoreRepository implements ProductUserOrderRepositoryContract
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    public function paginate(int $quantity, int $page, ProductUserOrderFilter $filter): LengthAwarePaginator
    {
        return $this->startConditions()->filter($filter)->paginate($quantity, ['*'], 'page', $page);
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
}
