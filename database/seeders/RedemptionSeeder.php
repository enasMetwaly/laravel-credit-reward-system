<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Redemption;
use App\Models\User;
use App\Models\Product;

class RedemptionSeeder extends Seeder
{
    public function run()
    {
        $user1 = User::where('email', 'ahmed.mohamed@email.com')->first();
        $product1 = Product::where('name', 'Wireless Headphones')->first();

        Redemption::create([
            'user_id' => $user1->id,
            'product_id' => $product1->id,
            'points_used' => $product1->points_required,
            'created_at' => now()->subHours(2),
            'updated_at' => now()->subHours(2),
        ]);
    }
}