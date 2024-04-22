<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Middleware\CheckRoles;
use App\Models\User;
use Illuminate\Http\Request;

class RolesMiddlewareTest extends TestCase
{
    private $admin;
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->admin = User::with('role')
            ->whereRelation('role', 'title', 'supper_admin')->first();
        $this->user = User::with('role')
            ->whereRelation('role', 'title', '<>', 'admin')
            ->whereRelation('role', 'title', '<>', 'supper_admin')
            ->first();
    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function test_admin_can_access_admin_route()
    {
        $this->actingAs($this->admin);
        $middleware = new CheckRoles;

        $request = Request::create('/', 'GET');
        $response = $middleware->handle($request, function () {
            return response('');
        });

        $this->assertEquals($response->getStatusCode(), 200);
    }


    public function test_user_can_access_user_route()
    {
        $this->actingAs($this->user);
        $middleware = new CheckRoles;

        $request = Request::create('/login', 'GET');
        $response = $middleware->handle($request, function () {
            return response('');
        });

        $this->assertEquals($response->getStatusCode(), 302);
        $this->assertEquals($response->getTargetUrl(), route('login'));
    }
}
