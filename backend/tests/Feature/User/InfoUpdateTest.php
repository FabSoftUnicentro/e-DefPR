<?php

namespace Tests\Feature\User;

use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InfoUpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Update a logged user
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $response1 = $this->actingAs($admin)->get('/user/me');

        $response1->assertSuccessful();

        $response2 = $this->actingAs($admin)->put('/user/me', [
            'name' => 'Test 2'
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/user/' . $admin->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test 2', $response3->json()['data']['name']);
    }
}
