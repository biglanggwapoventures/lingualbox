<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePastExperienceDurationToUserExperiences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_experiences', function (Blueprint $table) {
            $table->dropColumn(['years', 'months']);
            $table->date('start')->after('position');;
            $table->date('end')->after('start');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_experiences', function (Blueprint $table) {
            $table->integer('years')->unsigned()->after('position');
            $table->integer('months')->unsigned()->after('years');;
            $table->dropColumn(['start', 'end']);
        });
    }
}
