<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeededTeachersFullfillmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('needed_teachers_fullfillments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned();
            $table->date('date_fulfilled');
            $table->integer('morning')->unsigned();
            $table->integer('afternoon')->unsigned();
            $table->integer('evening')->unsigned();
            $table->integer('midnight')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('needed_teachers_fullfillments');
    }
}
