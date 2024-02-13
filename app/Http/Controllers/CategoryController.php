<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    //index
    public function index(){
        $categories = Category::with('outlet')->where('merchant_id', Auth::user()->merchant_id)->get();
        return view('pages.category.index', compact('categories'), ['type_menu' => 'product']);
    }

    //create
    public function create(){
        $outlets = Outlet::where('merchant_id', Auth::user()->merchant_id)->get();
        return view('pages.category.create', compact('outlets'), ['type_menu' => 'product']);
    }

    //store
    public function store(Request $request){
        $data = $request->all();
        $data['merchant_id'] = Auth::user()->merchant_id;
        Category::create($data);
        return redirect()->route('category.index')->with('res', ['status' => 'success', 'message' => 'Category created successfully']);
    }

    //edit
    public function edit($id){
        $outlets = Outlet::where('merchant_id', Auth::user()->merchant_id)->get();
        $category = Category::find($id);
        return view('pages.category.edit', compact(['outlets', 'category']), ['type_menu' => 'product']);
    }

    //update
    public function update(Request $request, $id){
        $data = $request->all();
        $category = Category::find($id);
        $category->update($data);
        return redirect()->route('category.index');
    }

    //destroy
    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index');
    }
}

