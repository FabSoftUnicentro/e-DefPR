<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssignRoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Assign role to a User
     */
    public function testAssignRole()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $user = factory(User::class)->create();

        $role = 'administrative-technician';

        $response = $this->actingAs($admin)->put("/user/$user->id/assign-role/$role");

        $response->assertSuccessful();

        $role = 'dont-exist';

        $response = $this->actingAs($admin)->put("/user/$user->id/assign-role/$role");

        $this->assertNotEquals(200, $response->getStatusCode());

        $response = $this->actingAs($admin)->put("/user/9999/assign-role/$role");

        $response->assertNotFound();
    }
}
