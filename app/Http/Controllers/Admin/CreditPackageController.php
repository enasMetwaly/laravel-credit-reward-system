<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreditPackage;
use Illuminate\Http\Request;

class CreditPackageController extends Controller
{
    public function index()
    {
        $creditPackages = CreditPackage::all();
        return view('admin.credit-packages.index', compact('creditPackages'));
    }

    public function create()
    {
        return view('admin.credit-packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_egp' => 'required|numeric',
            'credits' => 'required|integer',
            'reward_points' => 'required|integer',
        ]);

        CreditPackage::create($request->all());
        return redirect()->route('admin.credit-packages.index')->with('success', 'Credit package created successfully.');
    }

    public function edit(CreditPackage $creditPackage)
    {
        return view('admin.credit-packages.edit', compact('creditPackage'));
    }

    public function update(Request $request, CreditPackage $creditPackage)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_egp' => 'required|numeric',
            'credits' => 'required|integer',
            'reward_points' => 'required|integer',
        ]);

        $creditPackage->update($request->all());
        return redirect()->route('admin.credit-packages.index')->with('success', 'Credit package updated successfully.');
    }

    public function destroy(CreditPackage $creditPackage)
    {
        $creditPackage->delete();
        return redirect()->route('admin.credit-packages.index')->with('success', 'Credit package deleted successfully.');
    }
}