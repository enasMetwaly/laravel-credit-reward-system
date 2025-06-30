<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\User;
use App\Models\CreditPackage;

class PurchaseSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::where('email', 'ahmed.mohamed@email.com')->first();
        $user2 = User::where('email', 'fatima.ali@email.com')->first();
        $basicPackage = CreditPackage::where('name', 'Basic Pack')->first();
        $premiumPackage = CreditPackage::where('name', 'Premium Pack')->first();

        Purchase::create([
            'user_id' => $user1->id,
            'credit_package_id' => $basicPackage->id,
            'credits_earned' => $basicPackage->credits,
            'reward_points_earned' => $basicPackage->reward_points,
            'amount_paid_egp' => $basicPackage->price_egp,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Purchase::create([
            'user_id' => $user2->id,
            'credit_package_id' => $premiumPackage->id,
            'credits_earned' => $premiumPackage->credits,
            'reward_points_earned' => $premiumPackage->reward_points,
            'amount_paid_egp' => $premiumPackage->price_egp,
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);
    }
}