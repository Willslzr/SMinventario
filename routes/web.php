<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ConfiguracionController;

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

Route::get('/inicio', [DashboardController::class, 'main'])->middleware('auth')->name('dashboard');

Route::get('/inventario',[InventarioController::class, 'index'])->middleware('auth')->name('inventario.index');

Route::get('/configuracion',[ConfiguracionController::class, 'main'])->middleware('auth')->name('configuracion');

Route::get('/admin', function (){
    return view('layouts.admin');
});

Route::get('/login', [loginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login/auth', [LoginController::class, 'login'])->middleware('guest')->name('login.auth');

Route::get('/registrar', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

