<?php

namespace App\Providers;

use App\Http\Controllers\AuthController;
use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
    
        Fortify::authenticateUsing(function (Request $request) {
            // AuthenticateUser クラスの login メソッドを呼び出す
            return app(AuthenticateUser::class)->login($request->only('email', 'password'));
        });
        
        // ログインビューを指定
        Fortify::loginView(function () {
            return app(AuthController::class)->showLoginForm();
        });

        // 登録ビューを指定
        Fortify::registerView(function () {
            return app(AuthController::class)->showRegisterForm();
        });

        Event::listen(Registered::class, function ($event) {
            session()->flash('redirect_after_register', true);
        });
    }
}

