<?php

namespace Tests\Feature\Role;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AllPermissionsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get all permissions of a Role
     */
    public function testAllPermissions()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $response = $this->actingAs($admin)->get("/role/$admin->id/permissions");

        $response->assertSuccessful();

        $permissions = $response->json();

        foreach ($permissions as $permission) {
            $this->assertArrayHasKey('id', $permission);
            $this->assertArrayHasKey('name', $permission);
            $this->assertTrue($permission['chosen']);
        }
    }
}
