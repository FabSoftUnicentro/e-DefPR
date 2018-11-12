<?php

use Faker\Generator as Faker;
use App\Models\AttendmentType;

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

$factory->define(AttendmentType::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'description' => $faker->unique()->sentence
    ];
});
