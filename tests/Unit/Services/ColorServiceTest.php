<?php declare(strict_types=1);

namespace Services;

use App\Contracts\Services\ColorServiceContract;
use App\Http\Resources\API\Order\IndexResource;
use App\Models\Color;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class ColorServiceTest extends TestCase
{
    use RefreshDatabase;

    const COLOR_SERVICE_ABSTRACT = ColorServiceContract::class;

    public function testPaginate()
    {
        $this->withoutExceptionHandling();
        $quantity = 10;
        $page = 1;
        $path = '/admin/colors';

        $colors = Color::all();
        $total = count($colors);

        $pagination = new LengthAwarePaginator($colors, $total, $quantity, $page);

        $indexResource = IndexResource::collection($pagination);

        $this->mock(self::COLOR_SERVICE_ABSTRACT, function (MockInterface $mock) use ($quantity, $page, $path, $indexResource) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity, $page, $path)
                ->andReturn($indexResource);
        });

        $result = $this->app->make(self::COLOR_SERVICE_ABSTRACT)->paginate($quantity, $page, $path);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new Color();
        $model->id = $id;

        $this->mock(self::COLOR_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $model) {
            $mock->shouldReceive('findById')
                ->once()
                ->with($id)
                ->andReturn($model);
        });

        $result = $this->app->make(self::COLOR_SERVICE_ABSTRACT)->findById($id);

        $this->assertInstanceOf(Color::class, $result);
        $this->assertEquals($id, $result->id);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'Some title',
            'code' => '#ffffff',
        ];

        $this->mock(self::COLOR_SERVICE_ABSTRACT, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data);
        });

        $this->app->make(self::COLOR_SERVICE_ABSTRACT)->store($data);
    }

    public function testUpdateReturnNull()
    {
        $this->withoutExceptionHandling();


        $id = 1;
        $data = [
            'title' => 'Some new title',
            'code' => '#ffffa',
        ];

        $this->mock(self::COLOR_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturnNull();
        });

        $result = $this->app->make(self::COLOR_SERVICE_ABSTRACT)->update($id, $data);

        $this->assertNull($result);
    }

    public function testUpdateReturnStringWithValueTitle()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'title' => 'Some new title',
            'code' => '#fffffb',
        ];

        $this->mock(self::COLOR_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturn('title');
        });

        $result = $this->app->make(self::COLOR_SERVICE_ABSTRACT)->update($id, $data);

        $this->assertEquals('title', $result);
    }

    public function testUpdateReturnStringWithValueCode()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'title' => 'Some title',
            'code' => '#fffffb',
        ];

        $this->mock(self::COLOR_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturn('title');
        });

        $result = $this->app->make(self::COLOR_SERVICE_ABSTRACT)->update($id, $data);

        $this->assertEquals('title', $result);
    }

    public function testUpdateReturnStringWithValueTitleAndCode()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'title' => 'Some title',
            'code' => '#fffffb',
        ];

        $this->mock(self::COLOR_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturn('title&code');
        });

        $result = $this->app->make(self::COLOR_SERVICE_ABSTRACT)->update($id, $data);

        $this->assertEquals('title&code', $result);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $this->mock(self::COLOR_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('destroy')
                ->once()
                ->with($id);
        });

        $this->app->make(self::COLOR_SERVICE_ABSTRACT)->destroy($id);

        $this->assertDatabaseEmpty('colors');
    }
}
