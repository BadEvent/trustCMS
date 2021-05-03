<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'Super Admin',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Admin',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'Manager',
        ]);
        DB::table('roles')->insert([
            'role_name' => 'User',
        ]);
    }
}
