<?php

namespace Tests\Feature\Relative;

use App\Models\Relative;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\Relative as RelativeResource;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get a specific relative
     */
    public function testShow()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $relative = factory(Relative::class)->create();

        $response =  $this->actingAs($admin)->get('/relative/' . $relative->id);

        $response->assertResource(RelativeResource::make($relative));
    }
}
