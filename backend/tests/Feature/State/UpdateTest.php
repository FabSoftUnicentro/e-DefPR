<?php

namespace Tests\Feature\State;

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
     * @test Update a specific state
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $state = factory(State::class)->create([
            'name' => 'Test',
            'abbr' => 'TT'
        ]);

        $response1 = $this->actingAs($admin)->get('/state/' . $state->id);

        $response1->assertSuccessful();

        $this->assertEquals('Test', $response1->json()['data']['name']);

        $response2 = $this->actingAs($admin)->put('/state/' . $state->id, [
            'name' => 'Test 2'
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/state/' . $state->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test 2', $response3->json()['data']['name']);
    }
}
