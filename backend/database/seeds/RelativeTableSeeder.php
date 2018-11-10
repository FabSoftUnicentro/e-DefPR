<?php

use Illuminate\Database\Seeder;
use App\Models\Relative;

class RelativeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Relative::class, 10)->create();
    }
}
