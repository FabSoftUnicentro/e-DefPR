<?php

namespace Tests\Feature\AttendmentType;

use App\Models\AttendmentType;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\AttendmentType as AttendmentTypeResource;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get a specific attendment type
     */
    public function testShow()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $attendmentType = factory(AttendmentType::class)->create();

        $response =  $this->actingAs($admin)->get('/attendmentType/' . $attendmentType->id);

        $response->assertResource(AttendmentTypeResource::make($attendmentType));
    }
}
