<?php declare(strict_types=1);

namespace Repositories;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Http\Filters\ProductFilter;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    const PRODUCT_REPOSITORY_ABSTRACT = ProductRepositoryContract::class;

    public function testPaginate()
    {
        $this->withoutExceptionHandling();
        $quantity = 10;
        $page = 1;

        $items = [];
        $total = 0;
        $data = [
            'categories' => [1],
            'colors' => [1],
            'tags' => [1],
            'prices' => [1,2],
            'title' => 'some title',
        ];
        $filter = app()->make(ProductFilter::class,['queryParams' => array_filter($data)]);


        $lengthAwarePaginator = new LengthAwarePaginator($items, $total, $quantity, $page);

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($quantity, $page, $filter, $lengthAwarePaginator) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity,$page, $filter)
                ->andReturn($lengthAwarePaginator);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->paginate($quantity, $page, $filter);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new Product();
        $model->id = $id;

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $model) {
           $mock->shouldReceive('findById')
               ->once()
               ->with($id)
               ->andReturn($model);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->findById($id);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($id, $result->id);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'Some title',
            'quantity' => 1,
            'price' => 100.00,
            'description' => 'Some text',
            'additional' => 'Some text',
            'category_id' => 1,
        ];

        $model = new Product();
        $model->title = $data['title'];
        $model->quantity = $data['quantity'];
        $model->price = $data['price'];
        $model->description = $data['description'];
        $model->additional = $data['additional'];
        $model->category_id = $data['category_id'];

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($data, $model) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data)
                ->andReturn($model);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->store($data);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($data['title'], $result->title);
        $this->assertEquals($data['quantity'], $result->quantity);
        $this->assertEquals($data['price'], $result->price);
        $this->assertEquals($data['description'], $result->description);
        $this->assertEquals($data['additional'], $result->additional);
        $this->assertEquals($data['category_id'], $result->category_id);
    }

    public function testFindByTitle()
    {
        $this->withoutExceptionHandling();

        $title = 'Some title';

        $model = new Product();
        $model->title = $title;

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($title, $model) {
            $mock->shouldReceive('findByTitle')
                ->once()
                ->with($title)
                ->andReturn($model);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->findByTitle($title);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($title, $result->title);
    }

    public function testCount()
    {
        $this->withoutExceptionHandling();

        $count = 0;

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($count) {
            $mock->shouldReceive('count')
                ->once()
                ->andReturn($count);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->count();

        $this->assertEquals($count, $result);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('destroy')
                ->once()
                ->with($id);
        });

        $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->destroy($id);
    }

    public function testGetAll()
    {
        $this->withoutExceptionHandling();

        $collection = new Collection();

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($collection) {
            $mock->shouldReceive('getAll')
                ->once()
                ->andReturn($collection);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->getAll();

        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'title' => 'Some new title'
        ];

        $boll = true;

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $data, $boll) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturn($boll);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->update($id, $data);

        $this->assertEquals(true, $result);
    }

    public function testGetMinPrice()
    {
        $this->withoutExceptionHandling();

        $price = 150.00;

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($price) {
            $mock->shouldReceive('getMinPrice')
                ->once()
                ->andReturn($price);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->getMinPrice($price);

        $this->assertEquals($price, $result);
    }

    public function testGetMaxPrice()
    {
        $this->withoutExceptionHandling();

        $price = 150.00;

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($price) {
            $mock->shouldReceive('getMaxPrice')
                ->once()
                ->andReturn($price);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->getMaxPrice($price);

        $this->assertEquals($price, $result);
    }

    public function getRecentProducts()
    {
        $this->withoutExceptionHandling();

        $collection = new Collection();

        $this->mock(self::PRODUCT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($collection) {
            $mock->shouldReceive('getRecentProducts')
                ->once()
                ->andReturn($collection);
        });

        $result = $this->app->make(self::PRODUCT_REPOSITORY_ABSTRACT)->getRecentProducts();

        $this->assertInstanceOf(Collection::class, $result);
    }

}
