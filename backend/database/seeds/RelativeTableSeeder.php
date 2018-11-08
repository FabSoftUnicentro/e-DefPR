<?php

use Illuminate\Database\Seeder;

class RelativeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Relative::class, 10)->create();
    }
}
