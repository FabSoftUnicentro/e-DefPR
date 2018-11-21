<?php

use Faker\Generator as Faker;
use App\Models\User;
use App\Models\City;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'cpf' => (string) $faker->numberBetween(999999999),
        'birth_date' => $faker->date(),
        'birthplace' => DB::table('cities')->exists() ? DB::table('cities')->inRandomOrder()->first()->id : factory(City::class)->create(),
        'rg' => $faker->unique()->text(11),
        'rg_issuer' => 'SSP',
        'gender' => 'M',
        'marital_status' => 'Solteiro',
        'note' => null,
        'uf' => 'PR',
        'city' => 1,
        'number' => '123',
        'street' => 'Teste',
        'postcode' => '85015310',
        'complement' => '',
        'neighborhood' => 'Batel',
        'remember_token' => str_random(10),
        'must_change_password' => (string) 1
    ];
});
