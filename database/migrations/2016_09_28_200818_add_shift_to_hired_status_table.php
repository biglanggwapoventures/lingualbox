<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShiftToHiredStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hired_status', function (Blueprint $table) {
            $table->enum('shift', ['MORNING', 'AFTERNOON', 'EVENING', 'MIDNIGHT'])->nullable();
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
            $table->dropColumn('shift');
        });
    }
}
