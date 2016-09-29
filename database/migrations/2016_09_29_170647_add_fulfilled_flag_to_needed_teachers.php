<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFulfilledFlagToNeededTeachers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('needed_teachers', function (Blueprint $table) {
            $table->boolean('fulfilled')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('needed_teachers', function (Blueprint $table) {
            $table->dropColumn('fulfilled');
        });
    }
}
