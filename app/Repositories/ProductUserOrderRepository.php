<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ProductUserOrderRepositoryContract;
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
