<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postcodes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('postcode', 8)->unique();
            $table->string('street');
            $table->string('complement');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('uf', 2);
            $table->string('unity')->nullable();
            $table->integer('ibge_code');
            $table->integer('gia_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postcodes');
    }
}
