<?php

namespace Tests\Feature\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnassignPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Unassign permission to a User
     */
    public function testUnassignPermission()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        /** @var User $user */
        $user = factory(User::class)->create();

        $permission = 'register-activities';

        $user->givePermissionTo($permission);

        $response = $this->actingAs($admin)->put("/user/$user->id/unassign-permission/$permission");

        $response->assertSuccessful();

        $permission = 'dont-exist';

        $response = $this->actingAs($admin)->put("/user/$user->id/unassign-permission/$permission");

        $this->assertNotEquals(200, $response->getStatusCode());

        $response = $this->actingAs($admin)->put("/user/9999/unassign-permission/$permission");

        $response->assertNotFound();
    }

    /**
     * @test Unassign multiple permissions to a User
     */
    public function testUnassignMultiplePermissions()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        /** @var User $user */
        $user = factory(User::class)->create();

        $permissions = [
            'register-activities',
            'register-general-activities',
            'open-process'
        ];

        $user->givePermissionTo($permissions);

        $response = $this->actingAs($admin)->put("/user/$user->id/unassign-permissions", [
            'permissions' => $permissions
        ]);

        $response->assertSuccessful();

        $permissions = [
            'register-activities',
            'register-general-activities',
            'open-process',
            'dont-exist'
        ];

        $response = $this->actingAs($admin)->put("/user/$user->id/unassign-permissions", [
            'permissions' => $permissions
        ]);

        $this->assertNotEquals(200, $response->getStatusCode());

        $response = $this->actingAs($admin)->put("/user/999/unassign-permissions", [
            'permissions' => $permissions
        ]);

        $response->assertNotFound();
    }
}
