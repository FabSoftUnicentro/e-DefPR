<?php

namespace Tests\Feature\Role;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'UsersTableSeeder']);
    }

    /**
     * @test Store a specific role
     */
    public function testStore()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $role = [
            "name"=> "test",
            'description' => 'Test 1',
            "guard_name"=> "api"
        ];

        $response = $this->actingAs($admin)->post('/role/', $role);

        $response->assertSuccessful();
    }
}
