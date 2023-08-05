<?php declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User as Model;
use Illuminate\Pagination\LengthAwarePaginator;


/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends CoreRepository implements UserRepositoryContract
{

    protected function getModelClass(): string
    {
        return Model::class;
    }

    /**
     * @param int $quantity
     * @return LengthAwarePaginator
     */
    public function paginate(int $quantity): LengthAwarePaginator
    {
        return $this->startConditions()->paginate($quantity);
    }

    /**
     * @param string $email
     * @return Model|null
     */
    public function findByEmail(string $email): Model|null
    {
        return $this->startConditions()->where('email', '=', $email)->first();
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
}
