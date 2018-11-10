<?php

namespace Tests\Feature\Role;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Update a specific role
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $role = Role::create([
            'name' => 'Test 1',
            'description' => 'Test 1'
        ]);

        $response1 = $this->actingAs($admin)->get('/role/' . $role->id);

        $response1->assertSuccessful();

        $this->assertEquals('Test 1', $response1->json()['data']['name']);

        $response2 = $this->actingAs($admin)->put('/role/' . $role->id, [
            'name' => 'Test 2',
            'description' => 'Test 2'
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/role/' . $role->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test 2', $response3->json()['data']['name']);
    }
}
