<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Outlet;


class UserController extends Controller
{
    //index
    public function index(Request $request)
    {
        // Get the currently logged-in merchant's ID
        $user = Auth::user();
        $users = User::when($user && $user->outlet_id !== null, function ($query) use ($user) {
            return $query->where('outlet_id', $user->outlet_id);
        }, function ($query) use ($user) {
            return $query->where('merchant_id', $user->merchant_id);
        })
        ->when($request->search, function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })
        ->orderByDesc('id')
        ->paginate(10);

        return view('pages.user.index', compact('users'), ['type_menu' => '']);
    }

    //create
    public function create()
    {
        $user = Auth::user();
        $outlets = Outlet::when($user && $user->outlet_id !== null, function ($query) use ($user) {
            return $query->where('id', $user->outlet_id);
        }, function ($query) use ($user) {
            return $query->where('merchant_id', $user->merchant_id);
        })->get();
        return view('pages.user.create',  compact('outlets'), ['type_menu' => '']);
    }

    //store
    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $data['merchant_id'] = Auth::user()->merchant_id;
        User::create($data);
        return redirect()->route('user.index')->with('res', ['status' => 'success', 'message' => 'User created successfully']);
    }

    //edit
    public function edit($id)
    {
        $user = User::find($id);
        $outlets = Outlet::when($user && $user->outlet_id !== null, function ($query) use ($user) {
            return $query->where('id', $user->outlet_id);
        }, function ($query) use ($user) {
            return $query->where('merchant_id', $user->merchant_id);
        })->get();
        return view('pages.user.edit', compact('user', 'outlets'), ['type_menu' => '']);
    }

    //update
    public function update(Request $request, $id)
    {
        $data = $request->all();
        if ($request->password != null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user = User::find($id);
        $user->update($data);
        return redirect()->route('user.index');
    }

    //destroy
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index');
    }
}
