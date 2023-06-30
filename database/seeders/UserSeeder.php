<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' =>  'Suber',
            'last_name' =>   'Admin',
            'email' => 'super_admin@wafir.digital',
            'type' =>  'super_admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
