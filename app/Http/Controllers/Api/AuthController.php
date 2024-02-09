<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessTokenResult;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function login(Request $request){
       $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       $user = User::where('email', $loginData['email'])->first();

       if(!$user){
          return response([
              'message' => 'User not found'
          ], 404);
       }

       if(Hash::check($loginData['password'], $user->password)){
           $token = $user->createToken('auth_token')->plainTextToken;
           $response = [
               'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'phone' => $user->phone,
                'role' => $user->role,
            ],
               'token' => $token
           ];
           return response($response, 200);
       }else{
           return response([
               'message' => 'Email atau Password salah'
           ], 401);
       }

    }

    //logout
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response([
            'message' => 'Logout success'
        ], 200);

    }
}
