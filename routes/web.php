<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;

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

Route::get('/inicio', function () {
    return view('welcome');
});

Route::get('/admin', function (){
    return view('layouts.admin');
});

Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('', [LoginController::class, 'login'])->name('login.auth');

Route::get('/registrar', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

