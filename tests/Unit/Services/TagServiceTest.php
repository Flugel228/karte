<?php declare(strict_types=1);

namespace Services;

use App\Contracts\Services\TagServiceContract;
use App\Http\Resources\API\Order\IndexResource;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class TagServiceTest extends TestCase
{
    use RefreshDatabase;

    const TAG_SERVICE_ABSTRACT = TagServiceContract::class;

    public function testPaginate()
    {
        $this->withoutExceptionHandling();
        $quantity = 10;
        $page = 1;
        $path = '/admin/tags';

        $tags = Tag::all();
        $total = count($tags);

        $pagination = new LengthAwarePaginator($tags, $total, $quantity, $page);

        $indexResource = IndexResource::collection($pagination);

        $this->mock(self::TAG_SERVICE_ABSTRACT, function (MockInterface $mock) use ($quantity, $page, $path, $indexResource) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity, $page, $path)
                ->andReturn($indexResource);
        });

        $result = $this->app->make(self::TAG_SERVICE_ABSTRACT)->paginate($quantity, $page, $path);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testFindById()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new Tag();
        $model->id = $id;

        $this->mock(self::TAG_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $model) {
            $mock->shouldReceive('findById')
                ->once()
                ->with($id)
                ->andReturn($model);
        });

        $result = $this->app->make(self::TAG_SERVICE_ABSTRACT)->findById($id);

        $this->assertInstanceOf(Tag::class, $result);
        $this->assertEquals($id, $result->id);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'Some title',
        ];

        $this->mock(self::TAG_SERVICE_ABSTRACT, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data);
        });

        $this->app->make(self::TAG_SERVICE_ABSTRACT)->store($data);
    }

    public function testUpdateReturnNull()
    {
        $this->withoutExceptionHandling();


        $id = 1;
        $data = [
            'title' => 'Some new title',
        ];

        $this->mock(self::TAG_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturnNull();
        });

        $result = $this->app->make(self::TAG_SERVICE_ABSTRACT)->update($id, $data);

        $this->assertNull($result);
    }

    public function testUpdateReturnStringWithValueTitle()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'title' => 'Some new title',
        ];

        $this->mock(self::TAG_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id, $data) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturn('title');
        });

        $result = $this->app->make(self::TAG_SERVICE_ABSTRACT)->update($id, $data);

        $this->assertEquals('title', $result);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $this->mock(self::TAG_SERVICE_ABSTRACT, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('destroy')
                ->once()
                ->with($id);
        });

        $this->app->make(self::TAG_SERVICE_ABSTRACT)->destroy($id);

        $this->assertDatabaseEmpty('tags');
    }
}
