<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pruebaController;
use App\Http\Controllers\PersonalController;
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
Route::get('/codigoqr/{id}', [DashboardController::class, 'show'])->middleware('auth')->name('dashboard.codigoqr');
Route::get('/reporte/equipos/{id}', [DashboardController::class, 'reporteEquipos'])->middleware('auth')->name('dashboard.reporte.equipos');
Route::get('/reporte/materiales/{id}', [DashboardController::class, 'reportemateriales'])->middleware('auth')->name('dashboard.reporte.materiales');
Route::get('/reporte/historial/{id}', [DashboardController::class, 'reportehistorial'])->middleware('auth')->name('dashboard.reporte.historial');
Route::get('/reporte/general', [DashboardController::class, 'reportegeneral'])->middleware('auth')->name('reporte.general');
Route::get('/reporte/movimientos', [DashboardController::class, 'reportemovimientos'])->middleware('auth')->name('reporte.movimientos');
Route::get('/reporte/materiales', [DashboardController::class, 'reportearticulos'])->middleware('auth')->name('reporte.inventario');
Route::get('/reporte/recibidos', [DashboardController::class, 'reportearticulosrecibidos'])->middleware('auth')->name('reporte.reportearticulosrecibidos');

Route::get('/personal/index', [PersonalController::class, 'index'])->middleware('auth')->name('personal.index');
Route::get('/personal/show/{id}', [PersonalController::class, 'show'])->middleware('auth')->name('personal.show');

Route::get('/inventario',[InventarioController::class, 'index'])->middleware('auth')->name('inventario.index');
Route::get('/inventario/registrar',[InventarioController::class, 'create'])->middleware('auth')->name('inventario.create');
Route::post('/inventario/registrar',[InventarioController::class, 'store'])->middleware('auth')->name('inventario.store');
Route::get('/inventario/mover/{id}',[InventarioController::class, 'mover'])->middleware('auth')->name('inventario.mover');
Route::get('/inventario/mover/equipo/{id}',[InventarioController::class, 'moverequipo'])->middleware('auth')->name('inventario.moverequipo');
Route::post('/inventario/mover/equipo/asignar',[InventarioController::class, 'asignarequipo'])->middleware('auth')->name('inventario.asignarequipo');
Route::post('/inventario/move',[InventarioController::class, 'savemove'])->middleware('auth')->name('inventario.savemove');

Route::get('configuracion/departamentos',[ConfiguracionController::class, 'departamentos'])->middleware('auth')->name('configuracion.departamentos');
Route::post('configuracion/departamentos/store',[ConfiguracionController::class, 'departamentosstore'])->middleware('auth')->name('configuracion.departamentos.store');
Route::get('configuracion/personal',[ConfiguracionController::class, 'personal'])->middleware('auth')->name('configuracion.personal');
Route::post('configuracion/personal/store',[ConfiguracionController::class, 'personalstore'])->middleware('auth')->name('configuracion.personal.store');
Route::get('configuracion/categorias',[ConfiguracionController::class, 'categorias'])->middleware('auth')->name('configuracion.categorias');
Route::post('configuracion/categorias/store',[ConfiguracionController::class, 'categoriasstore'])->middleware('auth')->name('configuracion.categorias.store');

Route::get('/login', [loginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login/auth', [LoginController::class, 'login'])->middleware('guest')->name('login.auth');

Route::get('/registrar', [RegisterController::class, 'register'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

route::get('/test', [pruebaController::class, 'test'])->name('test');
