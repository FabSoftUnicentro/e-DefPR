<?php

namespace Tests\Feature\City;

use App\Models\City;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\City as CityResource;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get all cities paginated
     */
    public function testIndex()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        factory(City::class, 1)->create();

        $response = $this->actingAs($admin)->get('/city');

        $cities = City::orderBy('name', 'asc')->get();

        $response->assertResource(CityResource::collection($cities));
    }
}
