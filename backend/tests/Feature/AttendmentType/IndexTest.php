<?php

namespace Tests\Feature\AttendmentType;

use App\Models\AttendmentType;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\AttendmentType as AttendmentTypeResource;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get all attendment types paginated
     */
    public function testIndex()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        factory(AttendmentType::class, 5)->create();

        $response = $this->actingAs($admin)->get('/attendmentType');

        $attendmentTypes = AttendmentType::orderBy('name', 'asc')->paginate(10);

        $response->assertResource(AttendmentTypeResource::collection($attendmentTypes));
    }
}
