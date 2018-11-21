<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::beginTransaction();
        $this->call(RoleTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(AssistedTableSeeder::class);
        $this->call(AttendmentTypeTableSeeder::class);
        $this->call(AttendmentTableSeeder::class);
        $this->call(CounterPartTableSeeder::class);
        $this->call(RelativeTableSeeder::class);
        DB::commit();

        Model::reguard();
    }
}
