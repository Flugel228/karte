<?php declare(strict_types=1);

namespace Repositories;

use App\Contracts\Repositories\ProductUserCommentRepositoryContract;
use App\Models\ProductUserComment;
use App\Repositories\ProductUserCommentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class ProductUserCommentRepositoryTest extends TestCase
{
    const PRODUCT_USER_COMMENT_REPOSITORY_ABSTRACT = ProductUserCommentRepositoryContract::class;

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'product_id' => 1,
            'user_id' => 1,
            'comment' => 'Some text',
            'rate' => 5,
            'title' => 'Some title',
        ];

        $model = new ProductUserComment();
        $model->product_id = $data['product_id'];
        $model->user_id = $data['user_id'];
        $model->comment = $data['comment'];
        $model->rate = $data['rate'];
        $model->title = $data['title'];

        $this->mock(self::PRODUCT_USER_COMMENT_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($data, $model) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data)
                ->andReturn($model);
        });

        $result = $this->app->make(self::PRODUCT_USER_COMMENT_REPOSITORY_ABSTRACT)->store($data);

        $this->assertInstanceOf(ProductUserComment::class, $result);
        $this->assertEquals($data['product_id'], $result->product_id);
        $this->assertEquals($data['user_id'], $result->user_id);
        $this->assertEquals($data['comment'], $result->comment);
        $this->assertEquals($data['rate'], $result->rate);
        $this->assertEquals($data['title'], $result->title);
    }
}
