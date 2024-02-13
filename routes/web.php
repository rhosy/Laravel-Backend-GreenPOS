<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OutletController;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard', ['type_menu' => 'dashboard']);
    })->name('home');
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('merchant', MerchantController::class)->except(['create', 'store', 'destroy']);
    Route::resource('outlet', OutletController::class);
});

Route::get('city', function () {
    if(request()->province_id){
        return Regency::all()->where('province_id', request()->province_id);
    }
});

Route::get('district', function () {
    if(request()->regency_id){
        return District::all()->where('regency_id', request()->regency_id);
    }
});

Route::get('village', function () { 
    if(request()->district_id){
        return Village::all()->where('district_id', request()->district_id);
    }
});
