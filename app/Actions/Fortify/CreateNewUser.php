<?php

namespace App\Actions\Fortify;

use App\Models\Merchant;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'merchant_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

        $merchant = Merchant::create([
            'name' => $input['merchant_name']    
        ]);

        Outlet::create([
            'name' => $input['outlet_name'] ?? 'Outlet 1',
            'merchant_id' => $merchant->id
            
        ]);

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'role' => $input['role'] ?? 'admin',
            'password' => Hash::make($input['password']),
            'merchant_id' => $merchant->id,
        ]);
    }
}
