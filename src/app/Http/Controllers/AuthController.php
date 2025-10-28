<?php

namespace App\Http\Controllers;

use Illuminate\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 登録フォーム表示
    public function showRegisterForm()
    {
        return view('register');
    }

     // ログインフォーム表示
    public function showLoginForm()
    {
        return view('login');
    }




    

  /*  // 登録処理
    public function register(RegisterRequest $request)
    {
// バリデーション済みデータを取得
        $data = $request->validated();

        // 新規ユーザー作成
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // ログイン状態にする
        Auth::login($user);

        // 登録後は管理画面へリダイレクト
        return redirect()->route('admin.index');
    }

    // ログインフォーム表示
    public function showLoginForm()
    {
        return view('login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.index');
        }

        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。',
        ]);
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }*/

}
