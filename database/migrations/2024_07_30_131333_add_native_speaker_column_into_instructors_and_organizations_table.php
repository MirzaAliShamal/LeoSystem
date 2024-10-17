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
            $table->json('native_speaker')->nullable();
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->json('native_speaker')->nullable();
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
            $table->removeColumn('native_speaker');
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->removeColumn('native_speaker');
        });
    }
};
