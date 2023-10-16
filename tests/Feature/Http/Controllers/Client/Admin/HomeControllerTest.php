<?php

namespace Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\Admin\HomeController;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    /**
     * @test
     */
    public function __invoke_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin');

        $response->assertOk();
    }
}
