<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/crear-empresa', [EmpresaController::class, 'create'])->name('admin.empresa.create');
Route::get('/crear-empresa/pais/{id_pais}', [EmpresaController::class, 'buscar_estado'])->name('admin.empresa.buscar_estado');
Route::get('/crear-empresa/estado/{id_estado}', [EmpresaController::class, 'buscar_ciudad'])->name('admin.empresa.buscar_ciudad');
Route::post('/crear-empresa/create', [EmpresaController::class, 'store'])->name('admin.empresa.store');

//rutas para configuraciones
Route::get('/admin/configuracion', [EmpresaController::class, 'edit'])->name('admin.configuracion.edit');
Route::get('/admin/configuracion/pais/{id_pais}', [EmpresaController::class, 'buscar_estado'])->name('admin.empresa.buscar_estado');
Route::get('/admin/configuracion/estado/{id_estado}', [EmpresaController::class, 'buscar_ciudad'])->name('admin.empresa.buscar_ciudad');
Route::put('/admin/configuracion/{id}', [EmpresaController::class, 'update'])->name('admin.configuracion.update');

//rutas para configuraciones
Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
Route::post('/admin/roles/create', [RoleController::class, 'store'])->name('admin.roles.store');
Route::get('/admin/roles/{id}', [RoleController::class, 'show'])->name('admin.roles.show');
Route::get('/admin/roles/{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
