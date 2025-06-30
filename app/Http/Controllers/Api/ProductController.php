<?php

   namespace App\Http\Controllers\Api;

   use App\Http\Controllers\Controller;
   use App\Models\Product;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Log;
   use Illuminate\Support\Facades\Auth;


   class ProductController extends Controller
   {
       public function search(Request $request)
       {
           try {
               $query = $request->input('query', '');
               $perPage = $request->input('per_page', 10);
               $page = $request->input('page', 1);

               $products = Product::query()
                   ->where(function ($q) use ($query) {
                       $q->where('name', 'like', "%{$query}%")
                         ->orWhere('category', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%");
                   })
                   ->paginate($perPage, ['*'], 'page', $page);

               return response()->json([
                   'data' => $products->items(),
                   'total' => $products->total(),
                   'per_page' => $products->perPage(),
                   'current_page' => $products->currentPage(),
                   'last_page' => $products->lastPage(),
               ]);
           } catch (\Exception $e) {
               Log::error('Search error: ' . $e->getMessage());
               return response()->json(['error' => 'Internal server error'], 500);
           }
       }



        public function recommend(Request $request)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $points = $request->input('points', $user->reward_points);
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