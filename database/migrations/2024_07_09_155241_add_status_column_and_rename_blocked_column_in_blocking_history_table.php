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
        Schema::table('blocking_history', function (Blueprint $table) {
            $table->renameColumn('blocked_by','manage_user');
        });

        Schema::table('blocking_history', function (Blueprint $table) {
            $table->renameColumn('blocked','user');
        });

        Schema::table('blocking_history', function (Blueprint $table) {
            $table->addColumn('integer','status')->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocking_history', function (Blueprint $table) {
            $table->renameColumn('manage_user','blocked_by');
        });

        Schema::table('blocking_history', function (Blueprint $table) {
            $table->renameColumn('user','blocked');
        });

        Schema::table('blocking_history', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
