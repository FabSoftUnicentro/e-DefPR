<?php

namespace Tests\Feature\Permission;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Update a specific permission
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $permission = Permission::create([
            'name' => 'Test 1',
            'description' => 'Test 1'
        ]);

        $response1 = $this->actingAs($admin)->get('/permission/' . $permission->id);

        $response1->assertSuccessful();

        $this->assertEquals('Test 1', $response1->json()['data']['name']);

        $response2 = $this->actingAs($admin)->put('/permission/' . $permission->id, [
            'name' => 'Test 2',
            'description' => 'Test 2'
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/permission/' . $permission->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test 2', $response3->json()['data']['name']);
    }
}
