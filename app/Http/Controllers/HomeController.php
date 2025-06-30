<?php

namespace App\Http\Controllers;

use App\Models\CreditPackage;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     public function index()
    {
        $creditPackages = CreditPackage::all();
        $products = Product::where('is_redeemable', true)->get();
        return view('home', compact('creditPackages', 'products'));
    }
}