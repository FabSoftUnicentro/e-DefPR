<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\User as UserResource;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Delete a specific user
     */
    public function testDestroy()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $user = factory(User::class)->create([
            'name' => 'Test 1'
        ]);

        $response = $this->actingAs($admin)->get('/user/' . $user->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->delete('/user/' . $user->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->get('/user/' . $user->id);

        $response->assertNotFound();
    }
}
