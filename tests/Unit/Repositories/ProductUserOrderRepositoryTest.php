<?php declare(strict_types=1);

namespace Repositories;

use App\Contracts\Repositories\ProductUserOrderRepositoryContract;
use App\Models\ProductUserOrder;
use App\Repositories\ProductUserOrderRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;

class ProductUserOrderRepositoryTest extends TestCase
{
    const PRODUCT_USER_ORDER_REPOSITORY_ABSTRACT = ProductUserOrderRepositoryContract::class;

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'product_id' => 1,
            'user_id' => 1,
        ];

        $model = new ProductUserOrder();
        $model->product_id = $data['product_id'];
        $model->user_id = $data['user_id'];

        $this->mock(self::PRODUCT_USER_ORDER_REPOSITORY_ABSTRACT, function (MockInterface $mock) use ($data, $model) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data)
                ->andReturn($model);
        });

        $result = $this->app->make(self::PRODUCT_USER_ORDER_REPOSITORY_ABSTRACT)->store($data);

        $this->assertInstanceOf(ProductUserOrder::class, $result);
        $this->assertEquals($data['product_id'], $result->product_id);
        $this->assertEquals($data['user_id'], $result->user_id);
    }
}
