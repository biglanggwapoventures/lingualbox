<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeededTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('needed_teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('morning')->unsigned();
            $table->integer('afternoon')->unsigned();
            $table->integer('evening')->unsigned();
            $table->integer('midnight')->unsigned();
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
        Schema::drop('needed_teachers');
    }
}
