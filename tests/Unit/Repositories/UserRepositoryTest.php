<?php declare(strict_types=1);

namespace Repositories;

use App\Contracts\Repositories\UserRepositoryContract;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    const USER_REPOSITORY_ABSTRACT = UserRepositoryContract::class;

    public function testPaginate()
    {
        $this->withoutExceptionHandling();
        $quantity = 10;
        $page = 1;

        $items = [];
        $total = 0;


        $lengthAwarePaginator = new LengthAwarePaginator($items, $total, $quantity, $page);

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($quantity, $page, $lengthAwarePaginator) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity,$page)
                ->andReturn($lengthAwarePaginator);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->paginate($quantity, $page);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new User();
        $model->id = $id;

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $model) {
           $mock->shouldReceive('findById')
               ->once()
               ->with($id)
               ->andReturn($model);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->findById($id);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($id, $result->id);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'role' => 1,
            'gender' => 1,
            'address' => 'Some address',
            'telephone' => '+375293843923',
            'email' => 'example@mail.ru',
            'password' => 'SomePassword',
        ];

        $model = new User();
        $model->first_name = $data['first_name'];
        $model->last_name = $data['last_name'];
        $model->role = $data['role'];
        $model->gender = $data['gender'];
        $model->address = $data['address'];
        $model->telephone = $data['telephone'];
        $model->email = $data['email'];
        $model->password = $data['password'];

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($data, $model) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data)
                ->andReturn($model);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->store($data);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($data['first_name'], $result->first_name);
        $this->assertEquals($data['last_name'], $result->last_name);
        $this->assertEquals($data['role'], $result->role);
        $this->assertEquals($data['gender'], $result->gender);
        $this->assertEquals($data['address'], $result->address);
        $this->assertEquals($data['telephone'], $result->telephone);
        $this->assertEquals($data['email'], $result->email);
    }

    public function testFindByTitle()
    {
        $this->withoutExceptionHandling();

        $title = 'Some title';

        $model = new User();
        $model->title = $title;

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($title, $model) {
            $mock->shouldReceive('findByTitle')
                ->once()
                ->with($title)
                ->andReturn($model);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->findByTitle($title);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($title, $result->title);
    }

    public function testFindByEmail()
    {
        $this->withoutExceptionHandling();

        $email = 'example@mail.ru';

        $model = new User();
        $model->email = $email;

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($email, $model) {
            $mock->shouldReceive('findByEmail')
                ->once()
                ->with($email)
                ->andReturn($model);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->findByEmail($email);

        $this->assertInstanceOf(User::class, $result);
        $this->assertEquals($email, $result->email);
    }


    public function testCount()
    {
        $this->withoutExceptionHandling();

        $count = 0;

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($count) {
            $mock->shouldReceive('count')
                ->once()
                ->andReturn($count);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->count();

        $this->assertEquals($count, $result);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('destroy')
                ->once()
                ->with($id);
        });

        $this->app->make(self::USER_REPOSITORY_ABSTRACT)->destroy($id);
    }

    public function testGetAll()
    {
        $this->withoutExceptionHandling();

        $collection = new Collection();

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($collection) {
            $mock->shouldReceive('getAll')
                ->once()
                ->andReturn($collection);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->getAll();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'first_name' => 'first_name',
            'last_name' => 'last_name',
            'role' => 1,
            'gender' => 1,
            'address' => 'Some address',
            'telephone' => '+375293843923',
            'email' => 'example@mail.ru',
            'password' => 'SomePassword',
        ];

        $boll = true;

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $data, $boll) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturn($boll);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->update($id, $data);

        $this->assertEquals(true, $result);
    }

    public function testGetGenders()
    {
        $this->withoutExceptionHandling();

        $genders = [
            0 => 'Мужчина',
            1 => 'Женщина',
        ];

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($genders) {
            $mock->shouldReceive('getGenders')
                ->once()
                ->andReturn($genders);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->getGenders();

        $this->assertEquals($genders, $result);
    }

    public function testGetLikedProducts()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $collection = new Collection();

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $collection) {
            $mock->shouldReceive('getLikedProducts')
                ->once()
                ->with($id)
                ->andReturn($collection);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->getLikedProducts($id);

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testLikeProduct()
    {
        $this->withoutExceptionHandling();

        $data = [
            'user_id' => 1,
            'product_id' => 1,
        ];

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('likeProduct')
                ->once()
                ->with($data);
        });

        $this->app->make(self::USER_REPOSITORY_ABSTRACT)->likeProduct($data);
    }

    public function testCommentProduct()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $data = [
            'user_id' => 1,
            'product_id' => 1,
            'title' => 'Some title',
            'comment' => 'Some comment',
            'rate' => 5,
        ];

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('commentProduct')
                ->once()
                ->with($id, $data);
        });

        $this->app->make(self::USER_REPOSITORY_ABSTRACT)->commentProduct($id, $data);
    }

    public function testGetOrderProducts()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $collection = new Collection();

        $this->mock(self::USER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $collection) {
            $mock->shouldReceive('getOrderProducts')
                ->once()
                ->with($id)
                ->andReturn($collection);
        });

        $result = $this->app->make(self::USER_REPOSITORY_ABSTRACT)->getOrderProducts($id);

        $this->assertInstanceOf(Collection::class, $result);
    }

}
