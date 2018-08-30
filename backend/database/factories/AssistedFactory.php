<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\Assisted::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'cpf' => $faker->numberBetween(999999999),
        'birth_date' => $faker->date(),
        'birth_place' => json_encode([
            'uf' => 'PR',
            'city' => 'Guarapuava'
        ]),
        'rg' => $faker->unique()->text(11),
        'rg_issuer' => 'SSP',
        'gender' => 'M',
        'marital_status' => 'Solteiro',
        'profession' => 'Teste',
        //'counter_part' => $faker->name,
        'note' => null,
        'addresses' => json_encode([
            [
                'postcode' => '85015310',
                'street' => 'Teste',
                'number' => 1,
                'uf' => 'PR',
                'city' => 'Guarapuava',
                'neighborhood' => 'Batel',
                'complement' => ''
            ]
        ]),
    ];
});
