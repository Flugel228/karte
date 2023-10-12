<?php declare(strict_types=1);

namespace Services;

use App\Contracts\Services\ShopServiceContract;
use App\Http\Resources\API\Shop\ColorResource;
use App\Http\Resources\API\Shop\ProductResource;
use App\Http\Resources\API\Shop\CategoryResource;
use App\Http\Resources\API\Shop\RecentProductResource;
use App\Http\Resources\API\Shop\SingleProductResource;
use App\Http\Resources\API\Shop\TagResource;
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

class ShopServiceTest extends TestCase
{
    use RefreshDatabase;

    const SHOP_SERVICE_ABSTRACT = ShopServiceContract::class;

    public function testPaginate()
    {
        $this->withoutExceptionHandling();
        $quantity = 12;
        $data = [
            'page' => 1,
            'categories' =>[],
            'colors' => [],
            'tags' => [],
            'prices' => [],
            'title' => [],
        ];

        $products = Product::all();
        $total = count($products);

        $pagination = new LengthAwarePaginator($products, $total, $quantity, $data['page']);

        $productResource = ProductResource::collection($pagination);

        $this->mock(self::SHOP_SERVICE_ABSTRACT, function (MockInterface $mock) use ($quantity, $data, $productResource) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity, $data)
                ->andReturn($productResource);
        });

        $result = $this->app->make(self::SHOP_SERVICE_ABSTRACT)->paginate($quantity, $data);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testGetCategories()
    {
        $this->withoutExceptionHandling();

        $categories = Category::all();

        $categoryResource = CategoryResource::collection($categories);

        $this->mock(self::SHOP_SERVICE_ABSTRACT, function (MockInterface $mock) use ($categoryResource) {
            $mock->shouldReceive('getCategories')
                ->once()
                ->andReturn($categoryResource);
        });

        $result = $this->app->make(self::SHOP_SERVICE_ABSTRACT)->getCategories();

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testGetColors()
    {
        $this->withoutExceptionHandling();

        $colors = Color::all();

        $colorResource = ColorResource::collection($colors);

        $this->mock(self::SHOP_SERVICE_ABSTRACT, function (MockInterface $mock) use ($colorResource) {
            $mock->shouldReceive('getColors')
                ->once()
                ->andReturn($colorResource);
        });

        $result = $this->app->make(self::SHOP_SERVICE_ABSTRACT)->getColors();

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testGetTags()
    {
        $this->withoutExceptionHandling();

        $tags = Tag::all();

        $tagResource = TagResource::collection($tags);

        $this->mock(self::SHOP_SERVICE_ABSTRACT, function (MockInterface $mock) use ($tagResource) {
            $mock->shouldReceive('getTags')
                ->once()
                ->andReturn($tagResource);
        });

        $result = $this->app->make(self::SHOP_SERVICE_ABSTRACT)->getTags();

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testGetPrices()
    {
        $this->withoutExceptionHandling();

        $return = [
            'min' => 120.50,
            'max' => 150.70,
        ];

        $this->mock(self::SHOP_SERVICE_ABSTRACT, function (MockInterface $mock) use ($return) {
            $mock->shouldReceive('getPrices')
                ->once()
                ->andReturn($return);
        });

        $result = $this->app
            ->make(self::SHOP_SERVICE_ABSTRACT)
            ->getPrices();

        $this->assertEquals($return, $result);
    }

    public function testGetProduct()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new Product();
        $model->id = $id;
        $resource = SingleProductResource::make($model);

        $this->mock(self::SHOP_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $resource) {
            $mock->shouldReceive('getProduct')
                ->once()
                ->with($id)
                ->andReturn($resource);
        });

        $result = $this->app->make(self::SHOP_SERVICE_ABSTRACT)->getProduct($id);

        $this->assertEquals($resource, $result);
        $this->assertEquals($model->id, $result->id);
    }

    public function testGetRecentProducts()
    {
        $this->withoutExceptionHandling();

        $products = Product::all();

        $productResource = RecentProductResource::collection($products);

        $this->mock(self::SHOP_SERVICE_ABSTRACT, function (MockInterface $mock) use ($productResource) {
            $mock->shouldReceive('getRecentProducts')
                ->once()
                ->andReturn($productResource);
        });

        $result = $this->app->make(self::SHOP_SERVICE_ABSTRACT)->getRecentProducts($productResource);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }
}
