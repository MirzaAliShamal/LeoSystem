<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $newPermissions = [
            ['name' => 'teacher_blocked','guard_name' => 'web'],
            ['name' => 'teacher_history','guard_name' => 'web'],

            ['name' => 'student_blocked','guard_name' => 'web'],
            ['name' => 'student_history','guard_name' => 'web'],

            ['name' => 'organization_blocked','guard_name' => 'web'],
            ['name' => 'organization_history','guard_name' => 'web'],
        ];
        DB::table('permissions')->insert($newPermissions);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $newPermissions = [
            'teacher_blocked',
            'teacher_history',

            'student_blocked',
            'student_history',

            'organization_blocked',
            'organization_history'
        ];
        DB::table('permissions')->whereIn('name', $newPermissions)->delete();
    }
};
