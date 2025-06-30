<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product-catalog.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product-catalog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'is_redeemable' => 'required|boolean',
            'points_required' => 'nullable|integer|min:1|required_if:is_redeemable,1',
        ]);

        Product::create($request->all());
        return redirect()->route('admin.product-catalog.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.product-catalog.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'is_redeemable' => 'required|boolean',
            'points_required' => 'nullable|integer|min:1|required_if:is_redeemable,1',
        ]);

        $product->update($request->all());
        return redirect()->route('admin.product-catalog.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product-catalog.index')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $perPage = 10;

        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('category', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->paginate($perPage);

        return response()->json($products);
    }

    public function recommend(Request $request)
    {
        $userPoints = $request->input('points', 0);
        $products = Product::where('is_redeemable', true)->get();

        $recommendation = $products->filter(function ($product) use ($userPoints) {
            return $product->points_required <= $userPoints && $product->points_required > 0;
        })->sortByDesc('points_required')->first();

        if ($recommendation) {
            return response()->json(['recommended_product' => $recommendation]);
        }

        return response()->json(['message' => 'No suitable recommendation found'], 404);
    }
}