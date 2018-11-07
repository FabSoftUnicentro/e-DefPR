<?php

namespace Tests\Feature\AttendmentType;

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
     * @test Store a specific attendment type
     */
    public function testStore()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $attendmentType = [
            'name' => 'Test',
            'description' => 'Description'
        ];

        $response = $this->actingAs($admin)->post('/attendmentType/', $attendmentType);

        $response->assertSuccessful();
    }
}
