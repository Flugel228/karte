<?php

namespace Http\Controllers\Client\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
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

        $response = $this->get('/admin/users');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function create_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/users/create');

        $response->assertOk();
    }

    /**
     * @test
     */
    public function show_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->get("/admin/users/$user->id");

        $response->assertOk();
    }

    /**
     * @test
     */
    public function edit_method_response_assert_ok()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->get("/admin/users/$user->id/edit");

        $response->assertOk();
    }

    /**
     * @test
     */
    public function store_method_response_assert_ok_assert_database_count_one_and_assert_equals_true()
    {
        $this->withoutExceptionHandling();

        $data = [
            'first_name' => 'Michael',
            'last_name' => 'Philips',
            'role' => 0,
            'gender' => 0,
            'address' => 'Some address',
            'telephone' => '+375291234567',
            'email' => 'example@example.com',
            'password' => 'Password123',
            'confirm_password' => 'Password123',
        ];

        $response = $this->post('/admin/users', $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('users', 1);
        $user = User::first();

        $this->assertEquals($data['first_name'], $user->first_name);
        $this->assertEquals($data['last_name'], $user->last_name);
        $this->assertEquals($data['role'], $user->role);
        $this->assertEquals($data['gender'], $user->gender);
        $this->assertEquals($data['address'], $user->address);
        $this->assertEquals($data['telephone'], $user->telephone);
        $this->assertEquals($data['email'], $user->email);
    }

    /**
     * @test
     */
    public function update_method_response_assert_ok_assert_database_count_one_and_assert_equals_true()
    {
        $this->withoutExceptionHandling();

        $data = [
            'first_name' => 'Micha',
            'last_name' => 'Philips',
            'role' => 0,
            'gender' => 0,
            'address' => 'Some address',
            'telephone' => '+375291234567',
            'email' => 'example@example.com',
            'password' => 'Password123',
        ];

        $user = User::factory()->create();

        $response = $this->put("/admin/users/$user->id", $data);

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('users', 1);

        $user = User::find($user->id);

        $this->assertEquals($data['first_name'], $user->first_name);
        $this->assertEquals($data['last_name'], $user->last_name);
        $this->assertEquals($data['role'], $user->role);
        $this->assertEquals($data['gender'], $user->gender);
        $this->assertEquals($data['address'], $user->address);
        $this->assertEquals($data['telephone'], $user->telephone);
        $this->assertEquals($data['email'], $user->email);
    }

    /**
     * @test
     */
    public function destroy_method_response_assert_ok_assert_database_count_zero()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->delete("/admin/users/$user->id");

        $response->assertRedirect();

        $response = $this->followRedirects($response);

        $response->assertOk();

        $this->assertDatabaseCount('users', 0);
    }
}
