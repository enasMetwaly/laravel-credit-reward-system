<?php

namespace App\Http\Controllers;

use App\Models\CreditPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $creditPackages = CreditPackage::all();
        return view('home', compact('creditPackages'));
    }
}