<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_parts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->date('birth_date');
            $table->integer('birthplace')->unsigned();
            $table->foreign('birthplace')->references('id')->on('cities');
            $table->string('rg')->nullable();
            $table->string('rg_issuer')->nullable();
            $table->enum('gender', ['M', 'F', 'O']);
            $table->string('marital_status');
            $table->string('profession')->nullable();
            $table->text('note')->nullable();
            $table->text('document_type');
            $table->integer('document_number');
            $table->text('fantasy_name')->nullable();
            $table->json('addresses');
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
        Schema::dropIfExists('counter_parts');
    }
}
