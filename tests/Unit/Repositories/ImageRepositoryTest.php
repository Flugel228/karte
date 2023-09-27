<?php declare(strict_types=1);

namespace Repositories;

use App\Contracts\Repositories\ImageRepositoryContract;
use App\Models\Image;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class ImageRepositoryTest extends TestCase
{
    const IMAGE_REPOSITORY_ABSTRACT = ImageRepositoryContract::class;


    public function testFindById()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $model = new Image();
        $model->id = $id;

        $this->mock(self::IMAGE_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $model) {
           $mock->shouldReceive('findById')
               ->once()
               ->with($id)
               ->andReturn($model);
        });

        $result = $this->app->make(self::IMAGE_REPOSITORY_ABSTRACT)->findById($id);

        $this->assertInstanceOf(Image::class, $result);
        $this->assertEquals($id, $result->id);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'path' => '/images/image.jpg',
            'url' => 'https://localhost/images/image.jpg',
        ];

        $model = new Image();
        $model->path = $data['path'];
        $model->url = $data['url'];

        $this->mock(self::IMAGE_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($data, $model) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data)
                ->andReturn($model);
        });

        $result = $this->app->make(self::IMAGE_REPOSITORY_ABSTRACT)->store($data);

        $this->assertInstanceOf(Image::class, $result);
        $this->assertEquals($data['path'], $result->path);
        $this->assertEquals($data['url'], $result->url);
    }

    public function testUpdate()
    {
        $this->withoutExceptionHandling();

        $id = 1;
        $data = [
            'path' => '/images/new_image.jpg',
            'url' => 'https://localhost/images/new_image.jpg',
        ];

        $boll = true;

        $this->mock(self::IMAGE_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id, $data, $boll) {
            $mock->shouldReceive('update')
                ->once()
                ->with($id, $data)
                ->andReturn($boll);
        });

        $result = $this->app->make(self::IMAGE_REPOSITORY_ABSTRACT)->update($id, $data);

        $this->assertEquals(true, $result);
    }

    public function testDestroy()
    {
        $this->withoutExceptionHandling();

        $id = 1;

        $this->mock(self::IMAGE_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($id) {
            $mock->shouldReceive('destroy')
                ->once()
                ->with($id);
        });

        $this->app->make(self::IMAGE_REPOSITORY_ABSTRACT)->destroy($id);
    }

    public function testGetAll()
    {
        $this->withoutExceptionHandling();

        $collection = new Collection();

        $this->mock(self::IMAGE_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($collection) {
            $mock->shouldReceive('getAll')
                ->once()
                ->andReturn($collection);
        });

        $result = $this->app->make(self::IMAGE_REPOSITORY_ABSTRACT)->getAll();

        $this->assertInstanceOf(Collection::class, $result);
    }
}
