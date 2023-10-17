<?php

namespace Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\Admin\CategoryController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
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

        $response = $this->get('/admin/categories');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function create_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/categories/create');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function show_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $response = $this->get("/admin/categories/$category->id");

        $response->assertOk();
    }

    /**
     * @test
     */
    public function edit_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $response = $this->get("/admin/categories/$category->id/edit");

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
        ];

        $response = $this->post('/admin/categories', $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('categories', 1);
        $category = Category::first();

        $this->assertEquals($data['title'], $category->title);
    }

    /**
     * @test
     */
    public function update_method_response_assert_ok_assert_database_count_one_and_assert_equals_true()
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => 'Some new title',
        ];

        $category = Category::factory()->create();

        $response = $this->put("/admin/categories/$category->id", $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('categories', 1);

        $category = Category::find($category->id);

        $this->assertEquals($data['title'], $category->title);


    }

    /**
     * @test
     */
    public function destroy_method_response_assert_ok_assert_database_count_zero()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $response = $this->delete("/admin/categories/$category->id");

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('categories', 0);
    }
}
