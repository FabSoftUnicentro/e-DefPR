<?php

namespace Tests\Feature\Assisted;

use App\Models\Assisted;
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
     * @test Update a specific assisted
     */
    public function testUpdate()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $assisted = factory(Assisted::class)->create([
            'name' => 'Test 1'
        ]);

        $response1 = $this->actingAs($admin)->get('/assisted/' . $assisted->id);

        $response1->assertSuccessful();

        $this->assertEquals('Test 1', $response1->json()['data']['name']);

        $response2 = $this->actingAs($admin)->put('/assisted/' . $assisted->id, [
            'name' => 'Test 2'
        ]);

        $response2->assertSuccessful();

        $response3 = $this->actingAs($admin)->get('/assisted/' . $assisted->id);

        $response3->assertSuccessful();

        $this->assertEquals('Test 2', $response3->json()['data']['name']);
    }
}
