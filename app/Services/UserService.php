<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\ProductUserCommentRepositoryContract;
use App\Contracts\Repositories\Proxy\ProductUserCommentRepositoryProxyContract;
use App\Contracts\Repositories\Proxy\UserRepositoryProxyContract;
use App\Contracts\Services\UserServiceContract;
use App\Http\Resources\API\User\ProductResource;
use App\Http\Resources\Client\Admin\User\IndexResource;
use App\Services\Traits\DataCachingTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService extends CoreService implements UserServiceContract
{
    use DataCachingTrait;

    /**
     * @param UserRepositoryProxyContract $repository
     * @param ProductUserCommentRepositoryProxyContract $productUserCommentRepositoryContract
     */
    public function __construct(
        private readonly UserRepositoryProxyContract $repository,
        private readonly ProductUserCommentRepositoryProxyContract $productUserCommentRepositoryContract,
    )
    {
        parent::__construct();
    }

    /**
     * @param int $quantity
     * @param int $page
     * @param string $path
     * @return AnonymousResourceCollection
     */
    public function paginate(int $quantity, int $page, string $path): AnonymousResourceCollection
    {
        $users = $this->getRepository()->paginate($quantity, $page);
        $users = IndexResource::collection($users);
        $users->setPath($path);
        return $users;
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): Model|null
    {
        return $this->getRepository()->findById($id);
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $this->getRepository()->store($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return string|null
     */
    public function update(int $id, array $data): ?string
    {
        $user = $this->getRepository()->findByEmail($data['email']);
        if ($user === null or $user->id === $id) {
            $this->getRepository()->update($id, $data);
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
        $this->getRepository()->destroy($id);
    }

    /**
     * @return array
     */
    public function getGenders(): array
    {
        return $this->getRepository()->getGenders();
    }

    public function getLikedProducts(): AnonymousResourceCollection
    {
        $id = auth()->user()->id;
        $products = $this->getRepository()->getLikedProducts($id);
        return ProductResource::collection($products);
    }

    public function likeProduct(array $data): void
    {
        $data['user_id'] = auth()->user()->id;
        $this->getRepository()->likeProduct($data);
    }

    public function commentProduct(array $data): void
    {
        $data['user_id'] = auth()->user()->id;
        $this->getProductUserCommentRepositoryContract()->store($data);
    }

    /**
     * @return UserRepositoryProxyContract
     */
    public function getRepository(): UserRepositoryProxyContract
    {
        return $this->repository;
    }

    /**
     * @return ProductUserCommentRepositoryProxyContract
     */
    public function getProductUserCommentRepositoryContract(): ProductUserCommentRepositoryProxyContract
    {
        return $this->productUserCommentRepositoryContract;
    }
}
