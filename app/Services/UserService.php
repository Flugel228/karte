<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\UserServiceContract;
use App\Http\Resources\Client\Admin\User\IndexResource;
use App\Repositories\UserRepository as Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService extends CoreService implements UserServiceContract
{

    public function __construct(
        private readonly UserRepositoryContract $repository,
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
        $this->repository->store($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return string|null
     */
    public function update(int $id, array $data): ?string
    {
        $user = $this->repository->findByEmail($data['email']);
        if ($user === null or $user->id === $id) {
            $this->repository->update($id, $data);
            return null;
        }
        return 'email';
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
