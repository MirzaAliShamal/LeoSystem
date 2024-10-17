<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->string('first_name_en')->after('last_name');
            $table->string('last_name_en')->after('first_name_en');
            $table->string('middle_name_en')->after('last_name_en')->nullable();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->string('full_organization_name_en')->after('full_organization_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instructors', function (Blueprint $table) {
            $table->dropColumn('first_name_en');
            $table->dropColumn('middle_name_en');
            $table->dropColumn('last_name_en');
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('full_organization_name_en');
        });
    }
};
