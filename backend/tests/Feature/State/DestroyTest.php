<?php

namespace Tests\Feature\State;

use App\Models\State;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Delete a specific state
     */
    public function testDestroy()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $state = factory(State::class)->create([
            'name' => 'Test 1'
        ]);

        $response = $this->actingAs($admin)->get('/state/' . $state->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->delete('/state/' . $state->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->get('/state/' . $state->id);

        $response->assertNotFound();
    }
}
