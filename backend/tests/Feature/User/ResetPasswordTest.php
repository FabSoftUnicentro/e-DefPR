<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Reset the password of a User
     */
    public function testResetPassword()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put("/user/reset-password", [
            'password' => 'test'
        ]);

        $response->assertSuccessful();
    }
}
