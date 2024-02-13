<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Province;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletController extends Controller
{
    //index
    public function index()
    {
        $user = Auth::user();
        $outlets = $user->getOutlets();
        // if ($user && $user->outlet_id != null) {
        //     $outlets = Outlet::with('province')->where('id', $user->outlet_id)->get();
        // } else {
        //     $outlets = Outlet::with('province')->where('merchant_id', $user->merchant_id)->get();
        // }

        return view('pages.outlet.index', compact('outlets'), ['type_menu' => '']);
    }

    //create
    public function create()
    {
        $provinces = Province::all();
        return view('pages.outlet.create', compact('provinces'), ['type_menu' => '']);
    }

    //store
    public function store(Request $request)
    {
        $data = $request->all();
        $data['merchant_id'] = auth()->user()->merchant_id;
        Outlet::create($data);
        return redirect()->route('outlet.index')->with('res', ['status' => 'success', 'message' => 'User created successfully']);
    }

    //edit
    public function edit($id)
    {
        $outlet = Outlet::find($id);
        $provinces = Province::all();
        $cities = Regency::where('province_id', $outlet->province_id)->get();
        return view('pages.outlet.edit', compact('outlet', 'provinces', 'cities',), ['type_menu' => '']);
    }

    //update
    public function update(Request $request, $id)
    {
        $outlet = Outlet::find($id);
        $data = $request->all();
        $outlet->update($data);
        return redirect()->route('outlet.index')->with('res', ['status' => 'success', 'message' => 'Outlet updated successfully']);
    }
}
