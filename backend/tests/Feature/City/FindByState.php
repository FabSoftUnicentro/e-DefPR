<?php

namespace Tests\Feature\City;

use App\Models\City;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FindByState extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'StateTableSeeder']);
    }

    /**
     * @test Get a specific city through state id
     */
    public function testFindByState()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $city = factory(City::class)->create([
            'state_id' => 12
        ]);

        $response = $this->actingAs($admin)->get('/city/' . $city->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->get('/state/' . 13);

        $this->assertEquals($city->name, $response->json()['data']['name']);
    }
}
