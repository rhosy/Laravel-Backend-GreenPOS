<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get categories
        try {
        $categories = Category::all();
        $responseData = $categories->map(function ($categories) {
            return [
                'id' => $categories->id,
                'name' => $categories->name,
            ];
        });
        return response()->json(
            [
                'success' => true,
                'message' => 'Categories retrieved successfully',
                'categories' => $responseData
            ]
        );
    } catch (\Exception $e) {
        return response()->json(
            [
                'success' => false,
                'message' => $e->getMessage()
            ]
        );
    }
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
