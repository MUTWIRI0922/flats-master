<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone' => '0796635581',
            'email' => 'testuser@gmail.com',
            'password' => bcrypt('TestUser!2026'), // Use bcrypt to hash the password
        ]);
    }
}
