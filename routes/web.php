<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes(['except' => 'login']);

Route::post('/login',  [App\Http\Controllers\Auth\LoginController::class,'authenticate']);

Route::prefix('mesas')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin', [App\Http\Controllers\MesasController::class, 'index_admin'])->name('mesas-admin');
        Route::get('/admin/all', [App\Http\Controllers\MesasController::class, 'getadminall'])->name('mesas-admin-all');
        Route::get('/admin/{id}', [App\Http\Controllers\MesasController::class, 'showmodal'])->name('mesas-admin-modal');
        Route::post('/admin', [App\Http\Controllers\MesasController::class, 'store'])->name('mesas-admin-add');
        Route::put('/admin/{id}', [App\Http\Controllers\MesasController::class, 'actualizar'])->name('mesas-admin-update');
        Route::delete('/admin/{id}', [App\Http\Controllers\MesasController::class, 'delete'])->name('mesas-admin-delete');
    });
});
Route::prefix('usuarios')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin', [App\Http\Controllers\UsuarioContoller::class, 'index_admin'])->name('usuarios-admin');
        Route::get('/admin/all', [App\Http\Controllers\UsuarioContoller::class, 'getadminall'])->name('usuarios-admin-all');
        Route::get('/admin/{id}', [App\Http\Controllers\UsuarioContoller::class, 'showmodal'])->name('usuarios-admin-modal');
        Route::post('/admin', [App\Http\Controllers\UsuarioContoller::class, 'store'])->name('usuarios-admin-add');
        Route::put('/admin/{id}', [App\Http\Controllers\UsuarioContoller::class, 'actualizar'])->name('usuarios-admin-update');
        Route::delete('/admin/{id}', [App\Http\Controllers\UsuarioContoller::class, 'delete'])->name('usuarios-admin-delete');
    });
});
Route::prefix('productos')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin', [App\Http\Controllers\ProductosController::class, 'index_admin'])->name('productos-admin');
        Route::get('/admin/all', [App\Http\Controllers\ProductosController::class, 'getadminall'])->name('productos-admin-all');
        Route::get('/admin/{id}', [App\Http\Controllers\ProductosController::class, 'showmodal'])->name('productos-admin-modal');
        Route::post('/admin', [App\Http\Controllers\ProductosController::class, 'store'])->name('productos-admin-add');
        Route::post('/admin/{id}', [App\Http\Controllers\ProductosController::class, 'actualizar'])->name('productos-admin-update');
        Route::delete('/admin/{id}', [App\Http\Controllers\ProductosController::class, 'delete'])->name('productos-admin-delete');
    });
});

Route::prefix('ordenes')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/admin', [App\Http\Controllers\OrdenesController::class, 'index_admin'])->name('ordenes-admin');
        Route::get('/admin/all', [App\Http\Controllers\OrdenesController::class, 'getadminall'])->name('ordenes-admin-all');
        Route::get('/admin/{id}', [App\Http\Controllers\OrdenesController::class, 'showmodal'])->name('ordenes-admin-modal');
        Route::post('/admin', [App\Http\Controllers\OrdenesController::class, 'store'])->name('ordenes-admin-add');
        Route::put('/admin/{id}', [App\Http\Controllers\OrdenesController::class, 'actualizar'])->name('ordenes-admin-update');
        Route::delete('/admin/{id}', [App\Http\Controllers\OrdenesController::class, 'delete'])->name('ordenes-admin-delete');
    });
});

Route::middleware(['auth:admin,mesero'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});


