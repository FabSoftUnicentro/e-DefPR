<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StateTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AssistedTableSeeder::class);
        $this->call(AttendmentTypeTableSeeder::class);
        $this->call(AttendmentTableSeeder::class);
        $this->call(CounterPartTableSeeder::class);
    }
}
