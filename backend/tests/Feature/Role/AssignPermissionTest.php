<?php

namespace Tests\Feature\Role;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssignPermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Assign permission to a Role
     */
    public function testAssignPermission()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $role = Role::create([
            'name' => 'Test 1',
            'description' => 'Test 1'
        ]);

        $permission = 'register-activities';

        $response = $this->actingAs($admin)->put("/role/$role->id/assign-permission/$permission");

        $response->assertSuccessful();

        $permission = 'dont-exist';

        $response = $this->actingAs($admin)->put("/role/$role->id/assign-permission/$permission");

        $this->assertNotEquals(200, $response->getStatusCode());

        $response = $this->actingAs($admin)->put("/role/9999/assign-permission/$permission");

        $response->assertNotFound();
    }

    /**
     * @test Assign multiple permissions to a Role
     */
    public function testAssignMultiplePermissions()
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

        $response = $this->actingAs($admin)->put("/role/$role->id/assign-permissions", [
            'permissions' => $permissions
        ]);

        $response->assertSuccessful();

        $permissions = [
            'register-activities',
            'register-general-activities',
            'open-process',
            'dont-exist'
        ];

        $response = $this->actingAs($admin)->put("/role/$role->id/assign-permissions", [
            'permissions' => $permissions
        ]);

        $this->assertNotEquals(200, $response->getStatusCode());

        $response = $this->actingAs($admin)->put("/role/999/assign-permissions", [
            'permissions' => $permissions
        ]);

        $response->assertNotFound();
    }
}
