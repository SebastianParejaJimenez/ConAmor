<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
//Controladores


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

Auth::routes();


Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('facturas/pdf/{id_factura}', [FacturaController::class, 'pdf'])->name('facturas.pdf');
    Route::get('/get-product-price/{id_producto}', [FacturaController::class, 'getProductPrice'])->name('get-product-price');
    Route::get('/graficas/ventas/{ano}', [GraficasController::class, 'ventas'])->name('graficas.ventas');
    Route::get('productos/inactivo', [ProductoController::class,'inactivo'])->name('productos.inactivo');
    Route::get('productos/activo/{id_producto}', [ProductoController::class,'activo'])->name('productos.activo');    


    Route::resource('graficas', GraficasController::class);
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('documentos', DocumentoController::class);
    Route::resource('facturas', FacturaController::class);
    Route::resource('roles', RolController::class);
    Route::resource('clientes', ClienteController::class);
});


