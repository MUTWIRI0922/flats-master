<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'testuser@gmail.com'],
            [
            'first_name' => 'Test',
            'last_name' => 'User',
            'phone' => '0796635581',
            'password' => bcrypt('TestUser!2026'), // Use bcrypt to hash the password
            ]
        );

        $user->assignRole('Agent');
    }
}
