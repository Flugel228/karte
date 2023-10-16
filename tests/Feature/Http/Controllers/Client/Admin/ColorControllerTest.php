<?php

namespace Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\Admin\ColorController;
use App\Models\Color;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    /**
     * @test
     */
    public function index_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/colors');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function create_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/colors/create');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function show_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $color = Color::factory()->create();

        $response = $this->get("/admin/colors/$color->id");

        $response->assertOk();
    }

    /**
     * @test
     */
    public function edit_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $color = Color::factory()->create();

        $response = $this->get("/admin/colors/$color->id/edit");

        $response->assertOk();
    }

    /**
     * @test
     */
    public function store_method_response_assert_ok_assert_database_count_one_and_assert_equals_true()
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'Some title',
            'code' => '#ffffff',
        ];

        $response = $this->post('/admin/colors', $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('colors', 1);
        $color = Color::first();

        $this->assertEquals($data['title'], $color->title);
        $this->assertEquals($data['code'], $color->code);
    }

    /**
     * @test
     */
    public function update_method_response_assert_ok_assert_database_count_one_and_assert_equals_true()
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'Some new title',
            'code' => '#000000',
        ];

        $color = Color::factory()->create();

        $response = $this->put("/admin/colors/$color->id", $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('colors', 1);

        $color = Color::find($color->id);

        $this->assertEquals($data['title'], $color->title);
        $this->assertEquals($data['code'], $color->code);


    }

    /**
     * @test
     */
    public function destroy_method_response_assert_ok_assert_database_count_zero()
    {
        $this->withoutExceptionHandling();

        $color = Color::factory()->create();

        $response = $this->delete("/admin/colors/$color->id");

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('colors', 0);
    }
}
