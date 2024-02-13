<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchant;

class MerchantController extends Controller
{
    //index
    public function index() {
        $merchantId = Auth::user()->merchant_id;
        $merchants = Merchant::where('id', $merchantId)->get();
        return view('pages.merchant.index', compact('merchants'), ['type_menu' => '']);
    }

    //edit
    public function edit($id){
        $merchant = Merchant::find($id);
        return view('pages.merchant.edit', compact('merchant'), ['type_menu' => '']);
    }

    //update
    public function update(Request $request, $id){
        $merchant = Merchant::find($id);
        $data = $request->all();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $timestamp = now()->timestamp;
            $filename = "image_{$timestamp}.{$file->getClientOriginalExtension()}";
            $data['logo'] = $filename;
            $file->storeAs('public/images/merchant', $filename);
        }
        $merchant->update($data);
        return redirect()->route('merchant.index')->with('res', ['status' => 'success', 'message' => 'Merchant updated successfully']);
    }
}
