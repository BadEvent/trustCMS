<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data')->insert([
            'first_name' => 'Admin',
            'second_name' => 'Adminov',
            'phone' => '+79999999999',
            'organization_id' => '1',
        ]);
    }
}
