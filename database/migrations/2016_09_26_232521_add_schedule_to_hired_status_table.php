<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddScheduleToHiredStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hired_status', function (Blueprint $table) {
            $table->text('work_days')->nullable();
            $table->string('time_schedule')->nullable();
            $table->decimal('rate', 13, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hired_status', function (Blueprint $table) {
            $table->dropColumns(['work_days', 'time_schedule', 'rate']);
        });
    }
}
