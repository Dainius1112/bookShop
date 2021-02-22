<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
                'name' => 'Admin',
                'email' => 'admin123@admin.com',
                'password' => Hash::make('password'),
                'IsAdmin' => 1
            ],[
                'name' => 'Admin',
                'email' => 'admin321@admin.com',
                'password' => Hash::make('password'),
                'IsAdmin' => 0
            ]
        ]);
    }
}
