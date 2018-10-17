<?php

namespace Tests\Feature\User;

use Illuminate\Http\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'UsersTableSeeder']);
        $this->artisan('passport:install');
    }

    /**
     * @test Block unauthorized user from protected routes.
     *
     * @return void
     */
    public function testUnauthorized()
    {
        $response = $this->json('GET', '/user/me');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test Test authentication.
     */
    public function testAuthenticate()
    {
        $response = $this->json('POST', '/user/authenticate', [
            'login' => 'test',
            'password' => 'test'
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND);

        $response = $this->json('POST', '/user/authenticate', [
            'login' => 'master@edefpr.com',
            'password' => 'secret'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'name',
                'mustChangePassword'
            ]);
    }
}
