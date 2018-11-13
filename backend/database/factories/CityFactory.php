<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB as DB;
use App\Models\City;
use App\Models\State;

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

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'state_id' => DB::table('states')->exists() ? DB::table('states')->inRandomOrder()->first()->id : factory(State::class)->create(),
    ];
});
