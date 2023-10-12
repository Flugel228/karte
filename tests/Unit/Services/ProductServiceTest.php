<?php declare(strict_types=1);

namespace Services;

use App\Contracts\Services\ProductServiceContract;
use App\Http\Resources\Client\Admin\Product\IndexResource;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Testing\File;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    const PRODUCT_SERVICE_ABSTRACT = ProductServiceContract::class;

    public function testPaginate()
    {
        $this->withoutExceptionHandling();
        $quantity = 10;
        $page = 1;
        $path = '/admin/products';

        $products = Product::all();
        $total = count($products);

        $pagination = new LengthAwarePaginator($products, $total, $quantity, $page);

        $indexResource = IndexResource::collection($pagination);

        $this->mock(self::PRODUCT_SERVICE_ABSTRACT, function (MockInterface $mock) use ($quantity, $page, $path, $indexResource) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity, $page, $path)
                ->andReturn($indexResource);
        });

        $result = $this->app->make(self::PRODUCT_SERVICE_ABSTRACT)->paginate($quantity, $page, $path);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new Product();
        $model->id = $id;

        $this->mock(self::PRODUCT_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $model) {
            $mock->shouldReceive('findById')
                ->once()
                ->with($id)
                ->andReturn($model);
        });

        $result = $this->app->make(self::PRODUCT_SERVICE_ABSTRACT)->findById($id);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($id, $result->id);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $file = File::create('test_image.jpg', 1000);

        $data = [
            'title' => 'Some title',
            'quantity' => 100,
            'price' => 125.50,
            'description' => 'Some description',
            'additional' => 'Some additional',
            'category_id' => 1,
            'color_ids' => [1, 2, 3,],
            'tag_ids' => [1,2,3,],
            'images' => [$file,],
        ];

        $this->mock(self::PRODUCT_SERVICE_ABSTRACT, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data);
        });

        $this->app->make(self::PRODUCT_SERVICE_ABSTRACT)->store($data);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        $file = File::create('test_image.jpg', 1000);

        $id = 1;
        $data = [
            'title' => 'Some title',
            'quantity' => 100,
            'price' => 125.50,
            'description' => 'Some description',
            'additional' => 'Some additional',
            'category_id' => 1,
            'color_ids' => [1, 2, 3,],
            'tag_ids' => [1,2,3,],
            'images' => [$file,],
        ];

        $this->mock(self::PRODUCT_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data);
        });

        $this->app->make(self::PRODUCT_SERVICE_ABSTRACT)->update($id, $data);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $this->mock(self::PRODUCT_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('destroy')
                ->once()
                ->with($id);
        });

        $this->app->make(self::PRODUCT_SERVICE_ABSTRACT)->destroy($id);

        $this->assertDatabaseEmpty('products');
    }

    public function testGetAllCategoriesReturnCollection()
    {
        $this->withoutExceptionHandling();

        $collection = new Collection();

        $this->mock(self::PRODUCT_SERVICE_ABSTRACT, function (MockInterface $mock) use ($collection) {
            $mock->shouldReceive('getAllCategories')
                ->once()
                ->andReturn($collection);
        });

        $this->app->make(self::PRODUCT_SERVICE_ABSTRACT)->getAllCategories();
    }

    public function testGetAllColorsReturnCollection()
    {
        $this->withoutExceptionHandling();

        $collection = new Collection();

        $this->mock(self::PRODUCT_SERVICE_ABSTRACT, function (MockInterface $mock) use ($collection) {
            $mock->shouldReceive('getAllColors')
                ->once()
                ->andReturn($collection);
        });

        $this->app->make(self::PRODUCT_SERVICE_ABSTRACT)->getAllColors();
    }

    public function testGetAllTagsReturnCollection()
    {
        $this->withoutExceptionHandling();

        $collection = new Collection();

        $this->mock(self::PRODUCT_SERVICE_ABSTRACT, function (MockInterface $mock) use ($collection) {
            $mock->shouldReceive('getAllColors')
                ->once()
                ->andReturn($collection);
        });

        $this->app->make(self::PRODUCT_SERVICE_ABSTRACT)->getAllColors();
    }
}
