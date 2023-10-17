<?php

namespace Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\Admin\TagController;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagControllerTest extends TestCase
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

        $response = $this->get('/admin/tags');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function create_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/tags/create');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function show_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $tag = Tag::factory()->create();

        $response = $this->get("/admin/tags/$tag->id");

        $response->assertOk();
    }

    /**
     * @test
     */
    public function edit_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $tag = Tag::factory()->create();

        $response = $this->get("/admin/tags/$tag->id/edit");

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

        $response = $this->post('/admin/tags', $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('tags', 1);
        $tag = Tag::first();

        $this->assertEquals($data['title'], $tag->title);
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

        $tag = Tag::factory()->create();

        $response = $this->put("/admin/tags/$tag->id", $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('tags', 1);

        $tag = Tag::find($tag->id);

        $this->assertEquals($data['title'], $tag->title);


    }

    /**
     * @test
     */
    public function destroy_method_response_assert_ok_assert_database_count_zero()
    {
        $this->withoutExceptionHandling();

        $tag = Tag::factory()->create();

        $response = $this->delete("/admin/tags/$tag->id");

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('tags', 0);
    }
}
