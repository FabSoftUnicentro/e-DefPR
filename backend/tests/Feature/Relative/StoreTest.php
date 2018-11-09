<?php

namespace Tests\Feature\Relative;

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
     * @test Store a specific relative
     */
    public function testStore()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $relative = [
            "name"=> "Cadastro Teste",
            "email"=> "teste3@edefpr.com",
            "cpf"=> "08846355973",
            "birth_date"=> "26/08/1996",
            "rg"=> "Quaerat.",
            "rg_issuer"=> "SSP",
            "gender"=> "M",
            "marital_status"=> "Solteiro",
            "profession"=> "Teste",
            "birthplace"=> 1,
            "assisted_id" => 1,
            "addresses"=> [
                "uf"=> "PR",
                "city"=> "Guarapuava",
                "number"=> 1,
                "street"=> "Teste",
                "postcode"=> "85015310",
                "complement"=> "",
                "neighborhood"=> "Batel"
            ]
        ];

        $response = $this->actingAs($admin)->post('/relative/', $relative);

        $response->assertSuccessful();
    }
}
