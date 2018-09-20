<?php

use Illuminate\Database\Seeder;

class AttendmentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date("Y-m-d H:i:s");
        DB::table("attendment_types")->insert([
            [
                "name" => "Triagem Inicial",
                "description" => ".",
                "created_at" => $now,
                "updated_at" => $now
            ],
            [
                "name" => "Triagem Socioeconomica",
                "description" => ".",
                "created_at" => $now,
                "updated_at" => $now
            ],
            [
                "name" => "Atendimento Geral",
                "description" => ".",
                "created_at" => $now,
                "updated_at" => $now
            ],
            [
                "name" => "Atendimento Especial",
                "description" => ".",
                "created_at" => $now,
                "updated_at" => $now
            ]
        ]);
    }
}
