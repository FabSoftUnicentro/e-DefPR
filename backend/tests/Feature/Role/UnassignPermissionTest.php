<?php

namespace Tests\Feature\Role;

use App\Models\User;
use Spatie\Permission\Models\Role;
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
     * @test Unassign permission to a Role
     */
    public function testUnassignPermission()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $role = Role::create([
            'name' => 'Test 1',
            'description' => 'Test 1'
        ]);

        $permission = 'register-activities';

        $role->givePermissionTo($permission);

        $response = $this->actingAs($admin)->put("/role/$role->id/unassign-permission/$permission");

        $response->assertSuccessful();

        $permission = 'dont-exist';

        $response = $this->actingAs($admin)->put("/role/$role->id/unassign-permission/$permission");

        $this->assertNotEquals(200, $response->getStatusCode());

        $response = $this->actingAs($admin)->put("/role/9999/unassign-permission/$permission");

        $response->assertNotFound();
    }

    /**
     * @test Unassign multiple permissions to a Role
     */
    public function testUnassignMultiplePermissions()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $role = Role::create([
            'name' => 'Test 1',
            'description' => 'Test 1'
        ]);

        $permissions = [
            'register-activities',
            'register-general-activities',
            'open-process'
        ];

        $role->givePermissionTo($permissions);

        $response = $this->actingAs($admin)->put("/role/$role->id/unassign-permissions", [
            'permissions' => $permissions
        ]);

        $response->assertSuccessful();

        $permissions = [
            'register-activities',
            'register-general-activities',
            'open-process',
            'dont-exist'
        ];

        $response = $this->actingAs($admin)->put("/role/$role->id/unassign-permissions", [
            'permissions' => $permissions
        ]);

        $this->assertNotEquals(200, $response->getStatusCode());

        $response = $this->actingAs($admin)->put("/role/999/unassign-permissions", [
            'permissions' => $permissions
        ]);

        $response->assertNotFound();
    }
}
