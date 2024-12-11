<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/inicio', function () {
        return view('home');
    })->name('inicio');

    Route::get('/ventas', function () {
        return view('cashier/ventas');
    })->name('ventas');

    // Módulo de Inventario
    Route::get('/inventario', [inventoryController::class, 'index'])->name('productos.index');
    Route::post('/productos', [inventoryController::class, 'store'])->middleware('permission:crear')->name('productos.store');
    Route::delete('/productos/{id_producto}', [inventoryController::class, 'destroy'])->middleware('permission:eliminar')->name('productos.destroy');
    Route::get('/productos/{id_producto}/edit', [inventoryController::class, 'edit'])->middleware('permission:editar')->name('productos.edit');
    Route::put('/productos/{id_producto}', [inventoryController::class, 'update'])->middleware('permission:editar')->name('productos.update');


    // Perfil de usuario
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Gestión de usuarios
    Route::prefix('usuarios')->name('usuarios.')->middleware(['permission:ver'])->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->middleware('permission:editar')->name('edit');
        Route::match(['PUT', 'PATCH'], '/{user}', [UserController::class, 'update'])->middleware('permission:editar')->name('update'); // Acepta PUT y PATCH
        Route::delete('/{user}', [UserController::class, 'destroy'])->middleware('permission:eliminar')->name('destroy');
    });

    Route::get('/users/pdf', [UserController::class, 'generatePDF'])->name('users.pdf');

    Route::match(['GET', 'POST'], '/buscar', [ProductoController::class, 'buscar'])->name('productos.buscar');

    Route::post('/ventas/verificar-stock', [VentaController::class, 'verificarStock'])->name('ventas.verificarStock');

    Route::post('/ventas', [VentaController::class, 'guardarVenta'])->name('ventas.guardar');

    Route::get('/reporte-ventas-mensual', [VentaController::class, 'generarReporteMensual'])->name('ventas.reporteMensual');

    Route::get('/reporte-ventas-semanal', [VentaController::class, 'generarReporteSemanal'])->name('ventas.reporteSemanal');
    Route::post('/ventas/reporte-por-fecha', [VentaController::class, 'generarReportePorFecha'])->name('ventas.reporteFecha');
    
});

require __DIR__.'/auth.php';