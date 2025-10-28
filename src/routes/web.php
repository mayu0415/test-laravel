<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[ContactController::class,'index'])->name('contact.index');
Route::post('/confirm',[ContactController::class,'confirm'])->name('contact.confirm');
Route::post('/thanks',[ContactController::class,'send'])->name('contact.send');


//Route::get('/admin',[AdminController::class,'index'])->name('admin.index');

Route::get('/register',[AuthController::class,'showRegisterForm'])->name('register');
Route::get('/login',[AuthController::class,'showLoginForm'])->name('login');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
});

Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
