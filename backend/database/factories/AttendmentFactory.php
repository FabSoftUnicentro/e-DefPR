<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB as DB;
use App\Models\Attendment;
use App\Models\AttendmentType;
use App\Models\User;
use App\Models\Assisted;

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

$factory->define(Attendment::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph(),
        'type_id' => DB::table('attendment_types')->exists() ? DB::table('attendment_types')->inRandomOrder()->first()->id : factory(AttendmentType::class)->create(),
        'user_id' => DB::table('users')->exists() ? DB::table('users')->inRandomOrder()->first()->id : factory(User::class)->create(),
        'assisted_id' => DB::table('assisteds')->exists() ? DB::table('assisteds')->inRandomOrder()->first()->id : factory(Assisted::class)->create()
    ];
});
