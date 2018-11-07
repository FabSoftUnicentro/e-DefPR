<?php

namespace Tests\Feature\City;

use App\Models\City;
use App\Models\State;
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

        $cities = City::orderBy('id')->paginate(10);

        $collection = CityResource::collection($cities);
        $response->assertResource($collection->sortBy('name'));
    }

    /**
     * @test Get all cities
     */
    public function testIndexWithoutPagination()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $response = $this->actingAs($admin)->get('/city/?paginate=0');

        $cities = City::orderBy('id')->get();

        $collection = CityResource::collection($cities);
        
        $response->assertResource($collection->sortBy('name'));
    }
}
