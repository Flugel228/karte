<?php declare(strict_types=1);

namespace App\Services;

use App\Contracts\Repositories\ProductUserCommentRepositoryContract;
use App\Contracts\Repositories\UserRepositoryContract;
use App\Contracts\Services\UserServiceContract;
use App\Http\Resources\API\User\ProductResource;
use App\Http\Resources\Client\Admin\User\IndexResource;
use App\Models\User;
use App\Services\Traits\DataCachingTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class UserService extends CoreService implements UserServiceContract
{
    use DataCachingTrait;

    /**
     * @param UserRepositoryContract $repository
     * @param ProductUserCommentRepositoryContract $productUserCommentRepositoryContract
     */
    public function __construct(
        private readonly UserRepositoryContract $repository,
        private readonly ProductUserCommentRepositoryContract $productUserCommentRepositoryContract,
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
        $users = Cache::rememberForever("users:paginate:$page", function () use ($quantity, $page) {
            return $this->getRepository()->paginate($quantity, $page);
        });

        if ($users->items() === []) {
            abort(404);
        }

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
        return Cache::get("users:$id");
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $user = $this->getRepository()->store($data);
        $users = $this->getRepository()->getAll();

        Cache::put("users:$user->id", $user);
        Cache::put("users:all", $users);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'users', 10);
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
            $user = $this->getRepository()->findById($id);
            $users = $this->getRepository()->getAll();

            Cache::put("users:$id", $user);
            Cache::put("users:all", $users);

            $this->paginationCacheUpdateHandler($this->getRepository(), 'users', 10);
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
        Cache::forget("users:$id");

        $users = $this->getRepository()->getAll();
        Cache::put("users:all", $users);

        $this->paginationCacheUpdateHandler($this->getRepository(), 'users', 10);
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
     * @return UserRepositoryContract
     */
    public function getRepository(): UserRepositoryContract
    {
        return $this->repository;
    }

    /**
     * @return ProductUserCommentRepositoryContract
     */
    public function getProductUserCommentRepositoryContract(): ProductUserCommentRepositoryContract
    {
        return $this->productUserCommentRepositoryContract;
    }
}
