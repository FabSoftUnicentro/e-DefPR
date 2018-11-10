<?php

namespace Tests\Feature\Permission;

use App\Models\User;
use Tests\TestCase;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Store a specific permission
     */
    public function testStore()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $permission = [
            "name"=> "Test 1",
            'description' => 'Test 1'
        ];

        $response = $this->actingAs($admin)->post('/permission/', $permission);

        $response->assertSuccessful();
    }
}
