<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //index
    public function index(){
        $categories = Category::all();
        return view('pages.category.index', compact('categories'), ['type_menu' => 'product']);
    }

    //create
    public function create(){
        return view('pages.category.create', ['type_menu' => 'product']);
    }

    //store
    public function store(Request $request){
        $data = $request->all();
        Category::create($data);
        return redirect()->route('category.index')->with('res', ['status' => 'success', 'message' => 'Category created successfully']);
    }

    //edit
    public function edit($id){
        $category = Category::find($id);
        return view('pages.category.edit', compact('category'), ['type_menu' => 'product']);
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

