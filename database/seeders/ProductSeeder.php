<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'category' => 'Electronics',
            'name' => 'Wireless Headphones',
            'description' => 'High-quality wireless headphones with noise cancellation.',
            'image_url' => 'https://example.com/headphones.png',
            'is_redeemable' => true,
            'points_required' => 50,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'category' => 'Electronics',
            'name' => 'Smart Watch',
            'description' => 'A sleek smart watch with fitness tracking.',
            'image_url' => 'https://example.com/watch.png',
            'is_redeemable' => true,
            'points_required' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Product::create([
            'category' => 'Clothing',
            'name' => 'T-Shirt',
            'description' => 'Comfortable cotton t-shirt.',
            'image_url' => 'https://example.com/tshirt.png',
            'is_redeemable' => false,
            'points_required' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}