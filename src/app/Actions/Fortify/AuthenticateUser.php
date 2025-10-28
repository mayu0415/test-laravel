<?php

namespace App\Actions\Fortify;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function login(array $input)
    {
        $request = new LoginRequest();
        $validator = \Validator::make($input, $request->rules(), $request->messages());
        $validator->validate();

        if (Auth::attempt([
            'email' => $input['email'],
            'password' => $input['password'],
        ])) {
            return Auth::user();
        }

        return null;
    }
}