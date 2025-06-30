<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Check and create Ahmed Mohamed if not exists
        if (!User::where('email', 'ahmed.mohamed@email.com')->exists()) {
            User::create([
                'name' => 'Ahmed Mohamed',
                'email' => 'ahmed.mohamed@email.com',
                'password' => bcrypt('password123'),
                'credits' => 50, 
                'reward_points' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Check and create Fatima Ali if not exists
        if (!User::where('email', 'fatima.ali@email.com')->exists()) {
            User::create([
                'name' => 'Fatima Ali',
                'email' => 'fatima.ali@email.com',
                'password' => bcrypt('password123'),
                'credits' => 100, 
                'reward_points' => 25, 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}