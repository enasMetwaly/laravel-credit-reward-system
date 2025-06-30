<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditPackage;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Metrics
        $totalRevenue = CreditPackage::sum('price_egp');
        $lastMonthRevenue = CreditPackage::where('created_at', '<', Carbon::now()->subMonth())->sum('price_egp');
        $revenueChange = $lastMonthRevenue ? (($totalRevenue - $lastMonthRevenue) / $lastMonthRevenue * 100) : 0;
        $totalCredits = CreditPackage::sum('credits');
        $lastMonthCredits = CreditPackage::where('created_at', '<', Carbon::now()->subMonth())->sum('credits');
        $creditsChange = $lastMonthCredits ? (($totalCredits - $lastMonthCredits) / $lastMonthCredits * 100) : 0;

        // Approximate totalRedeemed and lastMonthRedeemed (placeholder until redemptions table is added)
        $totalRedeemed = Product::where('is_redeemable', true)->count(); // Count of redeemable products as a proxy
        $lastMonthRedeemed = Product::where('is_redeemable', true)->where('created_at', '<', Carbon::now()->subMonth())->count();
        $redeemedChange = $lastMonthRedeemed ? (($totalRedeemed - $lastMonthRedeemed) / $lastMonthRedeemed * 100) : 0;

        $activeUsers = DB::table('users')->where('created_at', '>=', Carbon::now()->subMonth())->count();
        $lastMonthUsers = DB::table('users')->where('created_at', '>=', Carbon::now()->subMonths(2))->where('created_at', '<', Carbon::now()->subMonth())->count();
        $usersChange = $lastMonthUsers ? (($activeUsers - $lastMonthUsers) / $lastMonthUsers * 100) : 0;

        // Recent Activities (based on real data - adjust when redemptions table is added)
        $recentActivities = collect([
            ['type' => 'purchase', 'description' => 'New credit package purchased', 'created_at' => CreditPackage::latest()->first()?->created_at ?? Carbon::now()],
        ])->sortByDesc('created_at')->take(3);

        // Top Products (based on redeemable products, placeholder count)
        $topProducts = Product::where('is_redeemable', true)
            ->select('products.*', DB::raw('0 as redemption_count')) // Placeholder, replace with real count when redemptions table exists
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        $creditPackages = CreditPackage::all();
        $products = Product::all(); // Pass all products for filtering in the view

        return view('admin.dashboard', compact(
            'creditPackages', 'products',
            'totalRevenue', 'revenueChange', 'totalCredits', 'creditsChange',
            'totalRedeemed', 'redeemedChange', 'activeUsers', 'usersChange',
            'recentActivities', 'topProducts'
        ));
    }
}