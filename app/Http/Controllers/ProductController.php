<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //index
    public function index(Request $request){
        $products = Product::with('category')->where('name', 'like', '%'.$request->search.'%')->paginate(8);
        return view('pages.product.index', compact('products'), ['type_menu' => 'product']);
    }

    //create
    public function create(){
        $categories = Category::all();
        return view('pages.product.create', compact('categories'), ['type_menu' => 'product']);
    }

    //store
    public function store(Request $request){
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $timestamp = now()->timestamp;
            $filename = "image_{$timestamp}.{$file->getClientOriginalExtension()}";
            $data['image'] = $filename;
            $file->storeAs('public/images/products', $filename);
        }
        Product::create($data);
        return redirect()->route('product.index')->with('res', ['status' => 'success', 'message' => 'Product created successfully']);
    }

    //edit
    public function edit($id){
        $product = Product::find($id);
        $categories = Category::all();
        return view('pages.product.edit', compact('product', 'categories'), ['type_menu' => 'product']);
    }

    //update
    public function update(Request $request, $id){
        $product = Product::find($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $timestamp = now()->timestamp;
            $filename = "image_{$timestamp}.{$file->getClientOriginalExtension()}";
            $data['image'] = $filename;
            $file->storeAs('public/images/products', $filename);
        }
        $product->update($data);
        return redirect()->route('product.index')->with('res', ['status' => 'success', 'message' => 'Product updated successfully']);
    }

    //destroy
    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
