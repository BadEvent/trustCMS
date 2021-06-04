<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'login' => 'superadmin',
            'email' => 'superadmin@admin.com',
            'password' => md5('superadmin'),
            'role_id' => '1',
            'data_id' => '1',
        ]);
    }
}
