<?php

namespace Tests\Feature\State;

use App\Models\User;
use App\Models\State;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\State as StateResource;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get all states paginated
     */
    public function testIndex()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        factory(State::class, 1)->create();

        $response =  $this->actingAs($admin)->get('/state');

        $states = State::orderBy('abbr', 'asc')->paginate(10);

        $response->assertResource(StateResource::collection($states));
    }

    /**
     * @test Get all states
     */
    public function testIndexWithoutPagination()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        factory(State::class, 1)->create();

        $response =  $this->actingAs($admin)->get('/state/?paginate=0');

        $states = State::orderBy('abbr', 'asc')->get();

        $response->assertResource(StateResource::collection($states));
    }
}
