<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuberAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => Str::random(10),
            'email' => 'admin@admin.com',
            'type' => 'super_admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
