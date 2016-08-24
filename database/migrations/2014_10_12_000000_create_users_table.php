<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthdate');
            $table->enum('gender', ['MALE', 'FEMALE']);
            $table->enum('marital_status', ['SINGLE', 'MARRIED', 'DIVORCED', 'SEPARATED', 'WIDOWED']);
            $table->string('street_address');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
