<?php

use Illuminate\Database\Seeder;
use App\Models\CounterPart;

class CounterPartTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\CounterPart::class, 10)->create();
    }
}
