<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Validation\ValidationException;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * Handle user registration.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        // RegisterRequest のルールとメッセージを取得
        $request = new RegisterRequest();
        $rules = $request->rules();
        $messages = $request->messages();

        // バリデーションを実行
        $validator = validator($input, $rules, $messages);

        if ($validator->fails()) {
            // バリデーション失敗時に Laravel の ValidationException を投げる
            throw new ValidationException($validator);
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}


        // RegisterRequestを使ってバリデーションを実行
        /*
        $request = new RegisterRequest();
        $validator = \Validator::make($input, $request->rules(), $request->messages());
        $validator->validate();
        */
