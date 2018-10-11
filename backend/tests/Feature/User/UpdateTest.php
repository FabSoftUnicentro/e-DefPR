<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\User as UserResource;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Update a specific user
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $user = factory(User::class)->create([
            'name' => 'Test 1'
        ]);

        $response1 = $this->actingAs($admin)->get('/user/' . $user->id);

        $this->assertEquals('Test 1', $response1->json()['data']['name']);

        $this->actingAs($admin)->put('/user/' . $user->id, [
            'name' => 'Test 2'
        ]);

        $response2 = $this->actingAs($admin)->get('/user/' . $user->id);

        $this->assertEquals('Test 2', $response2->json()['data']['name']);
    }
}
