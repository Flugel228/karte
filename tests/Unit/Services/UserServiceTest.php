<?php declare(strict_types=1);

namespace Services;

use App\Contracts\Services\UserServiceContract;
use App\Http\Resources\API\Order\IndexResource;
use App\Http\Resources\API\User\ProductResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    const USER_SERVICE_ABSTRACT = UserServiceContract::class;

    public function testPaginate()
    {
        $this->withoutExceptionHandling();
        $quantity = 10;
        $page = 1;
        $path = '/admin/users';

        $users = User::all();
        $total = count($users);

        $pagination = new LengthAwarePaginator($users, $total, $quantity, $page);

        $indexResource = IndexResource::collection($pagination);

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($quantity, $page, $path, $indexResource) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity, $page, $path)
                ->andReturn($indexResource);
        });

        $result = $this->app->make(self::USER_SERVICE_ABSTRACT)->paginate($quantity, $page, $path);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new User();
        $model->id = $id;

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $model) {
            $mock->shouldReceive('findById')
                ->once()
                ->with($id)
                ->andReturn($model);
        });

        $result = $this->app->make(self::USER_SERVICE_ABSTRACT)->findById($id);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($id, $result->id);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [

            'first_name' => 'Michael',
            'last_name' => 'Philips',
            'role' => 0,
            'gender' => 0,
            'address' => 'Some address',
            'telephone' => '+375291234567',
            'email' => 'example@mail.com',
            'password' => 'password',
        ];

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data);
        });

        $this->app->make(self::USER_SERVICE_ABSTRACT)->store($data);
    }

    public function testUpdateReturnNull()
    {
        $this->withoutExceptionHandling();


        $id = 1;
        $data = [
            'first_name' => 'Michael',
            'last_name' => 'Philips',
            'role' => 0,
            'gender' => 0,
            'address' => 'Some address',
            'telephone' => '+375291234567',
            'email' => 'new.example@mail.com',
            'password' => 'password',
        ];

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturnNull();
        });

        $result = $this->app->make(self::USER_SERVICE_ABSTRACT)->update($id, $data);

        $this->assertNull($result);
    }

    public function testUpdateReturnStringWithValueEmail()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'first_name' => 'Michael',
            'last_name' => 'Philips',
            'role' => 0,
            'gender' => 0,
            'address' => 'Some address',
            'telephone' => '+375291234567',
            'email' => 'new.example@mail.com',
            'password' => 'password',
        ];

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturn('email');
        });

        $result = $this->app->make(self::USER_SERVICE_ABSTRACT)->update($id, $data);

        $this->assertEquals('email', $result);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('destroy')
                ->once()
                ->with($id);
        });

        $this->app->make(self::USER_SERVICE_ABSTRACT)->destroy($id);

        $this->assertDatabaseEmpty('users');
    }

    public function testGetGenders()
    {
        $this->withoutExceptionHandling();

        $return = [
            0 => 'Мужчина',
            1 => 'Женщина',
        ];

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($return) {
            $mock->shouldReceive('getGenders')
                ->once()
                ->andReturn($return);
        });

        $result = $this->app->make(self::USER_SERVICE_ABSTRACT)->getGenders();

        $this->assertEquals($return, $result);
    }

    public function testGetLikedProducts()
    {
        $this->withoutExceptionHandling();

        $products = Product::all();

        $resource = ProductResource::collection($products);

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($resource) {
            $mock->shouldReceive('getLikedProducts')
                ->once()
                ->andReturn($resource);
        });

        $result = $this->app->make(self::USER_SERVICE_ABSTRACT)->getLikedProducts();

        $this->assertEquals($resource, $result);
    }

    public function testLikeProduct()
    {
        $this->withoutExceptionHandling();

        $data = [
            'product_id' => 1,
        ];

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('likeProduct')
                ->once()
                ->with($data);
        });

        $this->app->make(self::USER_SERVICE_ABSTRACT)->likeProduct($data);
    }

    public function testCommentProduct()
    {
        $this->withoutExceptionHandling();

        $data = [
            'product_id' => 1,
            'title' => 'Some title',
            'comment' => 'Some text',
            'rate' => 5,
        ];

        $this->mock(self::USER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('commentProduct')
                ->once()
                ->with($data);
        });

        $this->app->make(self::USER_SERVICE_ABSTRACT)->commentProduct($data);
    }
}
