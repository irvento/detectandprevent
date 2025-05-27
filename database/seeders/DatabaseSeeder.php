<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        if (!User::where('email', 'irvenabarquez@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'irvenabarquez@gmail.com',
                'password' => bcrypt('irvenabarquez@gmail.com'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]);
        }

        // Create test user if it doesn't exist
        if (!User::where('email', 'test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
    }
}
