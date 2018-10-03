<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('attendment_types');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('assisted_id')->unsigned();
            $table->foreign('assisted_id')->references('id')->on('assisteds');
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
        Schema::dropIfExists('attendments');
    }
}
