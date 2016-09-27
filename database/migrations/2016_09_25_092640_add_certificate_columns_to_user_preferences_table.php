<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCertificateColumnsToUserPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->dropColumn('certificates_filename');
            $table->text('remarks')->nullable()->after('demo_time');
            $table->string('tesol_certificate_filename')->nullable()->after('internet_speed_screenshot_filename');
            $table->string('tefl_certificate_filename')->nullable()->after('tesol_certificate_filename');
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
            $table->string('certificates_filename')->nullable();
            $table->dropColumn(['tesol_certificate_filename', 'tefl_certificate_filename', 'remarks']);
        });
    }
}
