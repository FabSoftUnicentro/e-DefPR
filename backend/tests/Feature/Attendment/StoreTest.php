<?php

namespace Tests\Feature\Attendment;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'RoleTableSeeder']);
        $this->artisan('db:seed', ['--class' => 'UsersTableSeeder']);
    }

    /**
     * @test Store a specific attendment
     */
    public function testStore()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $attendment = [
            "description" => "Cadastro Teste",
            "type_id" => 1,
            "user_id" => 1,
            "assisted_id" => 1
        ];

        $response = $this->actingAs($admin)->post('/attendment/', $attendment);

        $response->assertSuccessful();
    }
}
