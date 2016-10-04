<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFailReasonToWrittenExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('written_exam_results', function (Blueprint $table) {
            $table->text('fail_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('written_exam_results', function (Blueprint $table) {
            $table->dropColumn(['fail_reason']);
        });
    }
}
