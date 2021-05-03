<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization')->insert([
            'name' => 'TWD',
            'address' => 'Tomsk',
            'housing' => '1',
            'office' => '3211',
        ]);
    }
}
