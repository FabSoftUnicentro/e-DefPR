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
        self::markTestSkipped();
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

        $role = Role::create(['name' => 'Test']);

        $response1 = $this->actingAs($admin)->get('/role/' . $role->id);

        $response1->assertSuccessful();

        $this->assertEquals('Test', $response1->json()['data']['name']);

        $response2 = $this->actingAs($admin)->put('/role/' . $role->id, [
            'name' => 'Test2'
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/role/' . $role->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test2', $response3->json()['data']['name']);
    }
}
