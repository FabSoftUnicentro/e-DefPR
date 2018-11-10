<?php

use Faker\Generator as Faker;
use App\Models\Postcode;

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

$factory->define(Postcode::class, function (Faker $faker) {
    return [
        'postcode' => $faker->numberBetween(9999999),
        'street' => $faker->address,
        'complement' => '',
        'neighborhood' => 'Test',
        'city' => $faker->city,
        'uf' => str_random(2),
        'unity' => '',
        'ibge_code' => $faker->numberBetween(99999),
        'gia_code' => $faker->numberBetween(99999)
    ];
});
