<?php

use Illuminate\Database\Seeder;
use App\Models\Attendment;

class AttendmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Attendment::class, 10)->create();
    }
}
