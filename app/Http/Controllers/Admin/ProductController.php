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
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $points = $user->reward_points;
        $products = Product::where('is_redeemable', true)->get();

        $recommendation = $products->filter(function ($product) use ($points) {
            return $product->points_required <= $points && $product->points_required > 0;
        })->sortByDesc('points_required')->first();

        if ($recommendation) {
            return response()->json([
                'message' => 'Recommendation found',
                'recommended_product' => [
                    'id' => $recommendation->id,
                    'name' => $recommendation->name,
                    'category' => $recommendation->category,
                    'description' => $recommendation->description,
                    'points_required' => $recommendation->points_required,
                ],
            ]);
        }

        return response()->json(['message' => 'No suitable recommendation found'], 404);
    }
}