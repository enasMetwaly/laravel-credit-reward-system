<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CreditPackage;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index()
    {
        $creditPackages = CreditPackage::all();
        return response()->json(['data' => $creditPackages]);
    }


    public function store(Request $request)
    {
        $request->validate(['credit_package_id' => 'required|exists:credit_packages,id']);

        $creditPackage = CreditPackage::findOrFail($request->credit_package_id);
        $user = Auth::guard('sanctum')->user();

        // Create the purchase record
        $purchase = Purchase::create([
            'user_id' => $user->id,
            'credit_package_id' => $creditPackage->id,
            'credits_earned' => $creditPackage->credits,
            'reward_points_earned' => $creditPackage->reward_points,
            'amount_paid_egp' => $creditPackage->price_egp,
        ]);

        // Update user totals
        $user->credits += $creditPackage->credits;
        $user->reward_points += $creditPackage->reward_points;
        $user->save();

        // Refresh user data to ensure updated values
        $user = $user->fresh();

        // Prepare response with purchase and user details
        return response()->json([
            'message' => 'Purchase successful',
            'purchase' => [
                'id' => $purchase->id,
                'credit_package_name' => $creditPackage->name,
                'credits_earned' => $purchase->credits_earned,
                'reward_points_earned' => $purchase->reward_points_earned,
                'amount_paid_egp' => $purchase->amount_paid_egp,
                'created_at' => $purchase->created_at,
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