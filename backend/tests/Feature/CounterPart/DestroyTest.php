<?php

namespace Tests\Feature\CounterPart;

use App\Models\CounterPart;
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
     * @test Delete a specific counterPart
     */
    public function testDestroy()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $counterPart = factory(CounterPart::class)->create([
            'name' => 'Test 1'
        ]);

        $response = $this->actingAs($admin)->get('/counter-part/' . $counterPart->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->delete('/counter-part/' . $counterPart->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->get('/counter-part/' . $counterPart->id);

        $response->assertNotFound();
    }
}
