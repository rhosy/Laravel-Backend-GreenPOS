<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //get all products
        $limit = $request->limit ?? 10;
        $categoryId = $request->category_id ?? "";
        $keyword = $request->keyword ?? "";

        $query = Product::with('category');
        if($limit != ""){
            $query = $query->limit($limit);
        }
        if($categoryId != ""){
            $query = $query->where('category_id', $categoryId);
        }
        if($keyword != ""){
            $query = $query->where('name', 'like', '%'.$keyword.'%');
        }

        $products = $query->paginate($limit);
        $responseData = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'image' => asset("storage/images/products/{$product->image}"),
                'stock' => $product->stock,
                'category' => [
                    'id' => $product->category->id,
                    'name' => $product->category->name

                ]
            ];
        });
        return response()->json([
            'success' => true,
            'message' => 'Products retrieved successfully',
            'products' => $responseData,
            'pagination' => [
                'current_page' => $products->currentPage(),
                'per_page' => $products->perPage(),
                'total' => $products->total(),
                'last_page' => $products->lastPage(),
            ],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
