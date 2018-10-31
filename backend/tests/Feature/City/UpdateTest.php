<?php

namespace Tests\Feature\City;

use App\Models\City;
use App\Models\State;
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
     * @test Update a specific city
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $city = factory(City::class)->create([
            'name' => 'Test'
        ]);

        $response1 = $this->actingAs($admin)->get('/city/' . $city->id);

        $response1->assertSuccessful();

        $this->assertEquals('Test', $response1->json()['data']['name']);

        $response2 = $this->actingAs($admin)->put('/city/' . $city->id, [
            'name' => 'Test 2',
            'state_id' => $city->state_id
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/city/' . $city->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test 2', $response3->json()['data']['name']);
    }
}
