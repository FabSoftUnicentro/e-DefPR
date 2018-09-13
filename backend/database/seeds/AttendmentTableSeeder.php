<?php

use Illuminate\Database\Seeder;

class AttendmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Attendment::class, 10)->create();
    }
}
