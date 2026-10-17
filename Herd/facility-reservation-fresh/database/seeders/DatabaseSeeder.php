<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'admin@email.com'],
            [
                'name' => 'System Administrator',
                'password' => bcrypt('123456789'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Faculty Account
        User::updateOrCreate(
            ['email' => 'faculty@email.com'],
            [
                'name' => 'Prof. Robert Faculty',
                'password' => bcrypt('123456789'),
                'role' => 'faculty',
                'email_verified_at' => now(),
            ]
        );

        // 3. Student Account
        User::updateOrCreate(
            ['email' => 'student@email.com'],
            [
                'name' => 'Jane Student',
                'password' => bcrypt('123456789'),
                'role' => 'student',
                'email_verified_at' => now(),
            ]
        );

        // Call your resource seeder
        $this->call([
            ResourceSeeder::class,
        ]);
    }
}