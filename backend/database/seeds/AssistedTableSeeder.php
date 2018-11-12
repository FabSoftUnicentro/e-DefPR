<?php

use Illuminate\Database\Seeder;
use App\Models\Assisted;

class AssistedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Assisted::class, 10)->create();
    }
}
