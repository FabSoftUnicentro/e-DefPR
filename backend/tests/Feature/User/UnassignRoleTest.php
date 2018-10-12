<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnassignRoleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Unassign role to a User
     */
    public function testUnassignRole()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        /** @var User $user */
        $user = factory(User::class)->create();

        $role = 'administrative-technician';

        $user->assignRole($role);

        $response = $this->actingAs($admin)->put("/user/$user->id/unassign-role/$role");

        $response->assertSuccessful();

        $role = 'dont-exist';

        $response = $this->actingAs($admin)->put("/user/$user->id/unassign-role/$role");

        $this->assertNotEquals(200, $response->getStatusCode());

        $response = $this->actingAs($admin)->put("/user/9999/unassign-role/$role");

        $response->assertNotFound();
    }
}
