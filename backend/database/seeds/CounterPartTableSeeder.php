<?php

use Illuminate\Database\Seeder;
use App\Models\CounterPart;

class CounterPartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CounterPart::class, 10)->create();
        /*
        $counterpart = CounterPart::create([
            'name' => 'Counter Part 1',
            'email' => 'counter@gmail.com',
            'birthplace' => '1100056',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'Do contra',
            'document_type' => 'cpf',
            'document_number' => 1318510005,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ]),
        ]);

        $counterpart = CounterPart::create([
            'name' => 'Jamanta Skywalker Linderson',
            'email' => 'jajanaminha@gmail.com',
            'cpf' => '2318510005',
            'birthplace' => '1100056',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerato.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'Coletor de material radioativo',
            'document_type' => 'cpf',
            'document_number' => 1313510005,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ]),
        ]);

        $counterpart = CounterPart::create([
            'name' => 'Trator Maldito',
            'email' => 'tratorama2000@gmail.com',
            'cpf' => '3318510005',
            'birthplace' => '1100056',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'Puxador de barraco',
            'document_type' => 'cpf',
            'document_number' => 1218510005,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ])
        ]);

        $counterpart = CounterPart::create([
            'name' => 'Lindovauldo de Aquino Pexera Mendes',
            'email' => 'pexaolindo@gmail.com',
            'cpf' => '4318510005',
            'birthplace' => '1100056',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'Batedor de estaca',
            'document_type' => 'cpf',
            'document_number' => 1132510005,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ])
        ]);

        $counterpart = CounterPart::create([
            'name' => 'Jaodosvaldo da cruiz',
            'email' => 'jacruizo@gmail.com',
            'cpf' => '5318510005',
            'birthplace' => '1100056',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'Testador de asfalto',
            'document_type' => 'cpf',
            'document_number' => 1318510025,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ]),
        ]);


        $counterpart = CounterPart::create([
            'name' => 'Marivaldo Lucinta da Cordoba',
            'email' => 'lulucordoba@gmail.com',
            'cpf' => '6318510005',
            'birthplace' => '1100056',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'Desverminador de gente',
            'document_type' => 'cpf',
            'document_number' => 1318510105,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ]),
        ]);

        $counterpart = CounterPart::create([
            'name' => 'Rise of the Beasts',
            'email' => 'nuncanemvi@gmail.com',
            'cpf' => '7318510005',
            'birthplace' => '1100056',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'Caideiro de igreja',
            'document_type' => 'cpf',
            'document_number' => 1318513305,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ]),
        ]);

        $counterpart = CounterPart::create([
            'name' => 'Jordélio Amarantes Braquial',
            'email' => 'jojoama@gmail.com',
            'cpf' => '8318510005',
            'birthplace' => '1100056',
            'birth_date' => '2001-02-07',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'Plantador de cove',
            'document_type' => 'cpf',
            'document_number' => 1318510000,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ]),
        ]);

        $counterpart = CounterPart::create([
            'name' => 'Bazimur',
            'email' => 'master@gmail.com',
            'cpf' => '0000000000',
            'birthplace' => '1100056',
            'birth_date' => '2018-01-01',
            'rg' => 'Quaerat.',
            'rg_issuer' => 'SSP',
            'gender' => 'M',
            'marital_status' => 'Solteiro',
            'profession' => 'comedor de poeira',
            'document_type' => 'cpf',
            'document_number' => 1008510005,
            'addresses' => json_encode([
                [
                    'uf' => 'PR',
                    'city' => 'Guarapuava',
                    'number' => 1,
                    'street' => 'Teste',
                    'postcode' => '85015310',
                    'complement' => '',
                    'neighborhood' => 'Batel'
                ]
            ]),
        ]);
        */
    }
}
