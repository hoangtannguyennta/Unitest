<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Faker\Factory as Faker;

class AuthControllerTest extends TestCase
{
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::first();
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_user_view_login(): void
    {
        $response = $this->get(route('login'));
        $response->assertViewIs('auth.login');
        $response->assertStatus(200);
    }

    public function test_user_login_false(): void
    {
        $credential = ['email' => $this->user->email, 'password' => "a@b.c"];
        $response = $this->post(route('loginHandle'), $credential);
        $response->assertRedirect(route('login'));
        $response->assertStatus(302);
    }

    public function test_user_login_true(): void
    {
        $credential = ['email' => $this->user->email, 'password' => '12345678'];
        $response = $this->post(route('loginHandle'), $credential);
        $response->assertRedirect(route('home'));
    }

    public function test_user_view_register(): void
    {
        $response = $this->get(route('register'));
        $response->assertViewIs('auth.register');
        $response->assertStatus(200);
    }

    public function test_user_register_true(): void
    {
        $faker = Faker::create();
        $params = [
            'name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => '12345678'
        ];
        $response = $this->post(route('registerHandle'), $params);
        $response->assertStatus(302);
        $response->assertRedirect(route('home'));
    }

    public function test_user_register_false(): void
    {
        $params = [
            'name' => '',
            'email' => '',
            'password' => ''
        ];
        $response = $this->post(route('registerHandle'), $params);
        $response->assertStatus(302);
        $response->assertRedirect(route('register'));
    }
}
