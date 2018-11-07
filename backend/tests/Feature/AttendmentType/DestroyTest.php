<?php

namespace Tests\Feature\AttendmentType;

use App\Models\AttendmentType;
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
     * @test Delete a specific AttendmentType
     */
    public function testDestroy()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $attendmentType = factory(AttendmentType::class)->create();

        $response = $this->actingAs($admin)->get('/attendmentType/' . $attendmentType->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->delete('/attendmentType/' . $attendmentType->id);

        $response->assertSuccessful();

        $response = $this->actingAs($admin)->get('/attendmentType/' . $attendmentType->id);

        $response->assertNotFound();
    }
}
