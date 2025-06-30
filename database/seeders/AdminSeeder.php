<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Check if admin already exists
        if (!Admin::where('email', 'admin@example.com')->exists()) {
            Admin::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('111'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}