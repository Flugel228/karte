<?php declare(strict_types=1);

namespace Repositories;

use App\Contracts\Repositories\CategoryRepositoryContract;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class CategoryRepositoryTest extends TestCase
{
    const CATEGORY_REPOSITORY_ABSTRACT = CategoryRepositoryContract::class;

    public function testPaginate()
    {
        $this->withoutExceptionHandling();
        $quantity = 10;
        $page = 1;

        $items = [];
        $total = 0;


        $lengthAwarePaginator = new LengthAwarePaginator($items, $total, $quantity, $page);

        $this->mock(self::CATEGORY_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($quantity, $page, $lengthAwarePaginator) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity,$page)
                ->andReturn($lengthAwarePaginator);
        });

        $result = $this->app->make(self::CATEGORY_REPOSITORY_ABSTRACT)->paginate($quantity, $page);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new Category();
        $model->id = $id;

        $this->mock(self::CATEGORY_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $model) {
           $mock->shouldReceive('findById')
               ->once()
               ->with($id)
               ->andReturn($model);
        });

        $result = $this->app->make(self::CATEGORY_REPOSITORY_ABSTRACT)->findById($id);

        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals($id, $result->id);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'Some title'
        ];

        $model = new Category();
        $model->title = $data['title'];

        $this->mock(self::CATEGORY_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($data, $model) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data)
                ->andReturn($model);
        });

        $result = $this->app->make(self::CATEGORY_REPOSITORY_ABSTRACT)->store($data);

        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals($data['title'], $result->title);
    }

    public function testFindByTitle()
    {
        $this->withoutExceptionHandling();

        $title = 'Some title';

        $model = new Category();
        $model->title = $title;

        $this->mock(self::CATEGORY_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($title, $model) {
            $mock->shouldReceive('findByTitle')
                ->once()
                ->with($title)
                ->andReturn($model);
        });

        $result = $this->app->make(self::CATEGORY_REPOSITORY_ABSTRACT)->findByTitle($title);

        $this->assertInstanceOf(Category::class, $result);
        $this->assertEquals($title, $result->title);
    }

    public function testCount()
    {
        $this->withoutExceptionHandling();

        $count = 0;

        $this->mock(self::CATEGORY_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($count) {
            $mock->shouldReceive('count')
                ->once()
                ->andReturn($count);
        });

        $result = $this->app->make(self::CATEGORY_REPOSITORY_ABSTRACT)->count();

        $this->assertEquals($count, $result);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $this->mock(self::CATEGORY_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('destroy')
                ->once()
                ->with($id);
        });

        $this->app->make(self::CATEGORY_REPOSITORY_ABSTRACT)->destroy($id);
    }

    public function testGetAll()
    {
        $this->withoutExceptionHandling();

        $collection = new Collection();

        $this->mock(self::CATEGORY_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($collection) {
            $mock->shouldReceive('getAll')
                ->once()
                ->andReturn($collection);
        });

        $result = $this->app->make(self::CATEGORY_REPOSITORY_ABSTRACT)->getAll();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'title' => 'Some new title'
        ];


        $this->mock(self::CATEGORY_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturnTrue();
        });

        $result = $this->app->make(self::CATEGORY_REPOSITORY_ABSTRACT)->update($id, $data);

        $this->assertEquals(true, $result);
    }
}
