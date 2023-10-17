<?php

namespace Http\Controllers\Client\Admin;

use App\Http\Controllers\Client\Admin\ProductController;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Tests\TestCase;

class ProductControllerTest extends TestCase
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

        $response = $this->get('/admin/products');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function create_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/products/create');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function show_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        Category::factory()->create();
        Tag::factory()->create();
        Color::factory()->create();
        Image::factory()->create();

        $product = Product::factory()->create();

        $response = $this->get("/admin/products/$product->id");

        $response->assertOk();
    }

    /**
     * @test
     */
    public function edit_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        Category::factory()->create();
        Tag::factory()->create();
        Color::factory()->create();
        Image::factory()->create();

        $product = Product::factory()->create();

        $response = $this->get("/admin/products/$product->id/edit");

        $response->assertOk();
    }

    /**
     * @test
     */
    public function store_method_response_assert_ok_assert_database_count_one_and_assert_equals_true()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $colors = Color::factory(3)->create();
        $colorIds = [];
        foreach ($colors as $color) {
            $colorIds[] = $color->id;
        }
        $tags = Tag::factory(3)->create();
        $tagIds = [];
        foreach ($tags as $tag) {
            $tagIds[] = $tag->id;
        }
        $file = File::fake()->image('test_image.png', 1000, 1000)->size(100);
        $images = [$file];
        $data = [
            'title' => 'Some title',
            'quantity' => 120,
            'price' => 250.55,
            'description' => 'Some description',
            'additional' => 'Some additional',
            'category_id' => $category->id,
            'color_ids' => $colorIds,
            'tag_ids' => $tagIds,
            'images' => $images,
        ];

        $response = $this->post('/admin/products', $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('products', 1);
        $product = Product::first();

        $this->assertEquals($data['title'], $product->title);
        $this->assertEquals($data['quantity'], $product->quantity);
        $this->assertEquals($data['price'], $product->price);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['additional'], $product->additional);
        $this->assertEquals($data['category_id'], $product->category_id);
    }

    /**
     * @test
     */
    public function update_method_response_assert_ok_assert_database_count_one_and_assert_equals_true()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $colors = Color::factory(3)->create();
        $colorIds = [];
        foreach ($colors as $color) {
            $colorIds[] = $color->id;
        }
        $tags = Tag::factory(3)->create();
        $tagIds = [];
        foreach ($tags as $tag) {
            $tagIds[] = $tag->id;
        }
        $file = File::fake()->image('test_image.png', 1500, 1500)->size(100);
        $images = [$file];

        $data = [
            'title' => 'Some title',
            'quantity' => 120,
            'price' => 250.55,
            'description' => 'Some description',
            'additional' => 'Some additional',
            'category_id' => $category->id,
            'color_ids' => $colorIds,
            'tag_ids' => $tagIds,
            'images' => $images,
        ];

        $product = Product::factory()->create();

        $response = $this->put("/admin/products/$product->id", $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('products', 1);

        $product = Product::find($product->id);

        $this->assertEquals($data['title'], $product->title);
        $this->assertEquals($data['quantity'], $product->quantity);
        $this->assertEquals($data['price'], $product->price);
        $this->assertEquals($data['description'], $product->description);
        $this->assertEquals($data['additional'], $product->additional);
        $this->assertEquals($data['category_id'], $product->category_id);
    }

    /**
     * @test
     */
    public function destroy_method_response_assert_ok_assert_database_count_zero()
    {
        $this->withoutExceptionHandling();

        Category::factory()->create();
        Tag::factory()->create();
        Color::factory()->create();
        Image::factory()->create();

        $product = Product::factory()->create();

        $response = $this->delete("/admin/products/$product->id");

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('products', 0);
    }
}
