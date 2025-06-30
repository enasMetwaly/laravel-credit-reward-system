<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Redemption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedemptionController extends Controller
{
    public function index()
    {
        $redeemableProducts = Product::where('is_redeemable', true)->get();
        return response()->json(['data' => $redeemableProducts]);
    }
    public function store(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $product = Product::findOrFail($request->product_id);
        $user = Auth::guard('sanctum')->user();

        if (!$product->is_redeemable) {
            return response()->json(['error' => 'This product is not redeemable'], 400);
        }

        if ($user->reward_points < $product->points_required) {
            return response()->json(['error' => 'Insufficient reward points'], 400);
        }

        $redemption = Redemption::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'points_used' => $product->points_required,
        ]);

        $user->reward_points -= $product->points_required;
        $user->save();
        $user = $user->fresh();

        return response()->json([
            'message' => 'Redemption successful',
            'redemption' => [
                'id' => $redemption->id,
                'product_name' => $product->name,
                'points_used' => $redemption->points_used,
                'created_at' => $redemption->created_at,
            ],
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'total_credits' => $user->credits,
                'total_reward_points' => $user->reward_points,
            ],
        ], 201);
    }
}