<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //index
    public function index(Request $request){
        $users = DB::table('users')->where('name', 'like', '%'.$request->search.'%')
        ->orWhere('email', 'like', '%'.$request->search.'%')->orderBy('id', 'desc')
        ->paginate(10);
        return view('pages.user.index', compact('users'), ['type_menu' => '']);
    }

    //create
    public function create(){
        return view('pages.user.create', ['type_menu' => '']);
    }

    //store
    public function store(Request $request){
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return redirect()->route('user.index')->with('res', ['status' => 'success', 'message' => 'User created successfully']);
    }

    //edit
    public function edit($id){
        $user = User::find($id);
        return view('pages.user.edit', compact('user'), ['type_menu' => '']);
    }

    //update
    public function update(Request $request, $id){
        $data = $request->all();
        if($request->password != null){
            $data['password'] = Hash::make($data['password']);
        }else{
            unset($data['password']);
        }
        $user = User::find($id);
        $user->update($data);
        return redirect()->route('user.index');
    }

    //destroy
    public function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
