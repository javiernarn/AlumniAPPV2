<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeGuidanceCounselorEmail extends Migration
{
    private const OLD = 'occ.guidance@gmail.com';
    private const NEW = 'occ.verula.annabelle@gmail.com';

    public function up()
    {
        // Only the guidance counselor admin account is touched, and only if the
        // new address is not already taken by another user.
        $taken = DB::table('users')->where('email', self::NEW)->exists();
        if ($taken) {
            return;
        }

        DB::table('users')
            ->where('email', self::OLD)
            ->where('role', 'admin')
            ->update(['email' => self::NEW]);
    }

    public function down()
    {
        DB::table('users')
            ->where('email', self::NEW)
            ->where('role', 'admin')
            ->update(['email' => self::OLD]);
    }
}
