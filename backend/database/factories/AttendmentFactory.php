<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB as DB;

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

$factory->define(App\Models\Attendment::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph(),
        'type_id' => DB::table('attendment_types')->inRandomOrder()->first()->id,
        'user_id' => DB::table('users')->inRandomOrder()->first()->id
    ];
});
