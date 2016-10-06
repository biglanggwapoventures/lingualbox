<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeNeededTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('needed_teachers', function (Blueprint $table) {
            $table->integer('created_by')->unsigned()->after('midnight');
            $table->date('date_requested')->after('id');
            $table->softDeletes();
            $table->dropColumn('fulfilled');
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
            $table->boolean('fulfilled')->default(FALSE);
            $table->dropColumn(['created_by', 'date_requested', 'deleted_at']);
        });
    }
}
