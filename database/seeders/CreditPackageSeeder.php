<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CreditPackage;

class CreditPackageSeeder extends Seeder
{
    public function run()
    {
        CreditPackage::create([
            'name' => 'Basic Pack',
            'price_egp' => 50.00,
            'credits' => 50,
            'reward_points' => 10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        CreditPackage::create([
            'name' => 'Premium Pack',
            'price_egp' => 100.00,
            'credits' => 100,
            'reward_points' => 25,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}