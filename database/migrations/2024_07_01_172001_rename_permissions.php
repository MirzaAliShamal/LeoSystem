<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            DB::table('permissions')
                ->where('name', 'like', '%_instructor')
                ->update(['name' => DB::raw("REPLACE(name, '_instructor', '_teacher')")]);;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')
            ->where('name', 'like', '%_teacher')
            ->update(['name' => DB::raw("REPLACE(name, '_teacher', '_instructor')")]);
    }
};
