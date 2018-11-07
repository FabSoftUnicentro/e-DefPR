<?php

namespace Tests\Feature\AttendmentType;

use App\Models\AttendmentType;
use App\Models\User;
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
     * @test Update a specific attendment type
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $attendmentType = factory(AttendmentType::class)->create([
            'name' => 'Test 1',
            'description' => 'Description'
        ]);

        $response1 = $this->actingAs($admin)->get('/attendmentType/' . $attendmentType->id);

        $response1->assertSuccessful();

        $this->assertEquals('Test 1', $response1->json()['data']['name']);

        $response2 = $this->actingAs($admin)->put('/attendmentType/' . $attendmentType->id, [
            'name' => 'Test 2',
            'description' => 'Description'
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/attendmentType/' . $attendmentType->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test 2', $response3->json()['data']['name']);
    }
}
