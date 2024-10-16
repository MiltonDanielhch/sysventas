<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/crear-empresa', [EmpresaController::class, 'create'])->name('admin.empresa.create');
Route::get('/crear-empresa/pais/{id_pais}', [EmpresaController::class, 'buscar_estado'])->name('admin.empresa.buscar_estado');
Route::get('/crear-empresa/estado/{id_estado}', [EmpresaController::class, 'buscar_ciudad'])->name('admin.empresa.buscar_ciudad');
Route::post('/crear-empresa/create', [EmpresaController::class, 'store'])->name('admin.empresa.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
