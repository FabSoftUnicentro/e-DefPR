<?php

namespace Tests\Feature\Assisted;

use App\Models\Assisted;
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
     * @test Delete a specific assisted
     */
    public function testDestroy()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $assisted = factory(Assisted::class)->create([
            'name' => 'Test 1'
        ]);

        $response = $this->actingAs($admin)->get('/assisted/' . $assisted->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->delete('/assisted/' . $assisted->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->get('/assisted/' . $assisted->id);

        $response->assertNotFound();
    }
}
