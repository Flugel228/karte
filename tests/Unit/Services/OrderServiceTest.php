<?php declare(strict_types=1);

namespace Services;

use App\Contracts\Services\OrderServiceContract;
use App\Http\Resources\API\Order\IndexResource;
use App\Models\ProductUserOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\MockInterface;
use Tests\TestCase;


class OrderServiceTest extends TestCase
{
    use RefreshDatabase;

    const ORDER_SERVICE_ABSTRACT = OrderServiceContract::class;

    public function testIndexReturnAnonymousResourceCollection()
    {
        $this->withoutExceptionHandling();
        $quantity = 10;
        $page = 1;
        $path = '/api/users/auth/products/orders';
        $colors = ProductUserOrder::all();
        $total = count($colors);

        $pagination = new LengthAwarePaginator($colors, $total, $quantity, $page);

        $indexResource = IndexResource::collection($pagination);

        $this->mock(self::ORDER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($quantity, $page, $path, $indexResource) {
            $mock->shouldReceive('paginate')
                ->once()
                ->with($quantity, $page, $path)
                ->andReturn($indexResource);
        });

        $result = $this->app
            ->make(self::ORDER_SERVICE_ABSTRACT)
            ->paginate($quantity, $page, $path);

        $this->assertInstanceOf(AnonymousResourceCollection::class, $result);
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        $data = [
            'user_id' => 1,
            'product_id' => 1,
        ];

        $this->mock(self::ORDER_SERVICE_ABSTRACT, function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('store')
                ->once()
                ->with($data);
        });

        $this->app->make(self::ORDER_SERVICE_ABSTRACT)->store($data);
    }
}
