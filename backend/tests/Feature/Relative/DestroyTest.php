<?php

namespace Tests\Feature\Relative;

use App\Models\Relative;
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
     * @test Delete a specific relative
     */
    public function testDestroy()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $relative = factory(Relative::class)->create([
            'name' => 'Test 1'
        ]);

        $response = $this->actingAs($admin)->get('/relative/' . $relative->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->delete('/relative/' . $relative->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->get('/relative/' . $relative->id);

        $response->assertNotFound();
    }
}
