<?php

namespace Tests\Feature\Relative;

use App\Models\Relative;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\Relative as RelativeResource;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get all relatives paginated
     */
    public function testIndex()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        factory(Relative::class, 5)->create();

        $response =  $this->actingAs($admin)->get('/relative');

        $relatives = Relative::paginate(10);

        $response->assertResource(RelativeResource::collection($relatives));
    }
}
