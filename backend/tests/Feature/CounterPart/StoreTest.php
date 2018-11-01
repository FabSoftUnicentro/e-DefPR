<?php

namespace Tests\Feature\CounterPart;

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
     * @test Store a specific counterPart
     */
    public function testStore()
    {
        $admin = factory(User::class)->create();

        $admin->assignRole('master');

        $counterPart = [
            "name"=> "Cadastro Teste",
            "email"=> "teste3@counterPart.com",
            "birth_date"=> "26/08/1996",
            "rg"=> "Quaerat.",
            "rg_issuer"=> "SSP",
            "gender"=> "M",
            "profession"=> "Teste",
            "note"=>"",
            "addresses"=> json_encode([
                "uf"=> "PR",
                "city"=> "Guarapuava",
                "number"=> 1,
                "street"=> "Teste",
                "postcode"=> "85015310",
                "complement"=> "",
                "neighborhood"=> "Batel"
            ]),
            "document_type"=>"CPF",
            "document_number"=>"teste",
            "fantasy_name"=>"fantasia"
        ];

        $response = $this->actingAs($admin)->post('/counter-part/', $counterPart);

        $response->assertSuccessful();
    }
}
