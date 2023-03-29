<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SchoolchildrenUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('user_roles')->insert([
            [
                'code' => 'SCHOOLCHILDREN'
            ]
        ]);
    }
}
