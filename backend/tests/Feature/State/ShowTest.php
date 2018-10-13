<?php

namespace Tests\Feature\State;

use App\Models\State;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\State as StateResource;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get a specific state
     */
    public function testShow()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $state = factory(State::class)->create();

        $response =  $this->actingAs($admin)->get('/state/' . $state->id);

        $response->assertResource(StateResource::make($state));
    }
}
