<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\User as UserResource;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test the Forgot Password of a User
     */
    public function testForgotPassword()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        factory(User::class)->create([
            'email' => 'test@test.com',
            'cpf' => '12345678910'
        ]);

        $response = $this->actingAs($admin)->post('/user/forgot-password', [
            'email' => 'test@test.com',
            'cpf' => '12345678910'
        ]);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->post('/user/forgot-password', [
            'email' => 'test2@test.com',
            'cpf' => '12345678911'
        ]);

        $response->assertNotFound();
    }
}
