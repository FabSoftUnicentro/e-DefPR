<?php

use Illuminate\Database\Seeder;

class AssistedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Assisted::class, 10)->create();
    }
}
