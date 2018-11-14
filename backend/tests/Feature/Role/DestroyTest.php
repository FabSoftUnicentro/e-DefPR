<?php

namespace Tests\Feature\Role;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Delete a specific Role
     */
    public function testDestroy()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $role = Role::create([
            'name' => 'test',
            'description' => 'Test 1'
        ]);

        $response = $this->actingAs($admin)->get('/role/' . $role->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->delete('/role/' . $role->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->get('/role/' . $role->id);

        $response->assertNotFound();
    }
}
