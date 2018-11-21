<?php

use Faker\Generator as Faker;
use App\Models\CounterPart;

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

$factory->define(CounterPart::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'birth_date' => $faker->date(),
        'rg' => $faker->unique()->text(11),
        'rg_issuer' => 'SSP',
        'gender' => 'M',
        'profession' => 'Teste',
        'note' => null,
        'document_type' => 'cpf',
        'document_number' => $faker->numberBetween(999999999),
        'fantasy_name' => null,
        'uf' => 'PR',
        'city' => 1,
        'number' => '123',
        'street' => 'Teste',
        'postcode' => '85015310',
        'complement' => '',
        'neighborhood' => 'Batel',
    ];
});
