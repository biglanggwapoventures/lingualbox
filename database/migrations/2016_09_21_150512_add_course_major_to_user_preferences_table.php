<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseMajorToUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            // BALL: BA in Linguistics and Literature
            // BSCAE: BS Education major in Communication Arts English
            // BASC: BA Speech Communication
            $table->enum('major', ['BALL', 'BSCAE', 'BASC', 'OTHERS'])->after('user_id')->nullable();
            $table->string('other_major')->after('major')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->dropColumn(['major', 'other_major']);
        });
    }
}
