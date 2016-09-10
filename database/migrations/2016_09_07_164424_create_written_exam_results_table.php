<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWrittenExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('written_exam_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('written_exam_id')->unsigned();
            $table->text('answer');
            $table->integer('checked_by')->unsigned()->nullable();
            $table->enum('result', ['FAILED', 'PASSED'])->nullable();
            $table->timestamp('datetime_started')->default('0000-00-00 00:00:00');
            $table->timestamp('datetime_ended')->default('0000-00-00 00:00:00');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('checked_by')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('written_exam_id')
                ->references('id')->on('written_exams')
                ->onDelete('restrict')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('written_exam_results');
    }
}
