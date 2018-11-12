<?php

namespace Tests\Feature\Postcode;

use App\Models\Postcode;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Resources\Postcode as PostcodeResource;

class PostcodeSearchTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('key:generate');
        $this->artisan('passport:install');
    }

    /**
     * @test Search a postcode that already exists
     */
    public function testPostcodeSearchResource()
    {
        $address = factory(Postcode::class)->create();

        $response = $this->get('/postcode/' . $address->postcode);

        $response->assertResource(PostcodeResource::make($address));
    }

    /**
     * @test Search a postcode
     */
    public function testPostcodeSearch()
    {
        $postcode = "85015-310";

        $response = $this->get('/postcode/' . $postcode);

        $response->assertSuccessful();
    }

    /**
     * @test Search a inexistent postcode
     */
    public function testInexistentPostcodeSearch()
    {
        $postcode = "00000-000";

        $response = $this->get('/postcode/' . $postcode);

        $response->assertNotFound();
    }
}
