<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->enum('work_schedule', ['MORNING', 'AFTERNOON', 'EVENING', 'MIDNIGHT'])->nullable();
            $table->enum('demo_day', ['MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'])->nullable();
            $table->string('demo_time')->nullable();
            $table->string('display_photo_filename')->nullable();
            $table->string('internet_speed_screenshot_filename')->nullable();
            $table->string('certificates_filename')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
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
        Schema::drop('user_preferences');
    }
}
