<?php

namespace Tests\Feature\CounterPart;

use App\Models\CounterPart;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\CounterPart as CounterPartResource;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
    }

    /**
     * @test Get a specific counterPart
     */
    public function testShow()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $counterPart = factory(CounterPart::class)->create();

        $response =  $this->actingAs($admin)->get('/counter-part/' . $counterPart->id);

        $response->assertResource(CounterPartResource::make($counterPart));
    }
}
