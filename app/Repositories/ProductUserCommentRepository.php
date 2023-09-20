<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Contracts\Repositories\ProductUserCommentRepositoryContract;
use App\Http\Filters\ProductFilter;
use App\Models\ProductUserComment as Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class ProductRepository
 *
 * @package App\Repositories
 */
class ProductUserCommentRepository extends CoreRepository implements ProductUserCommentRepositoryContract
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
