<?php

namespace Tests\Feature\Attendment;

use App\Models\Attendment;
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
     * @test Update a specific attendment
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $attendment = factory(Attendment::class)->create([
            'description' => 'Test 1'
        ]);

        $response1 = $this->actingAs($admin)->get('/attendment/' . $attendment->id);

        $response1->assertSuccessful();

        $this->assertEquals('Test 1', $response1->json()['data']['description']);

        $response2 = $this->actingAs($admin)->put('/attendment/' . $attendment->id, [
            'description' => 'Test 2'
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/attendment/' . $attendment->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test 2', $response3->json()['data']['description']);
    }
}
