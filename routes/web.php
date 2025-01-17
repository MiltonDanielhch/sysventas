<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TmpCompraController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/crear-empresa', [EmpresaController::class, 'create'])->name('admin.empresa.create');
Route::get('/crear-empresa/pais/{id_pais}', [EmpresaController::class, 'buscar_estado'])->name('admin.empresa.buscar_estado');
Route::get('/crear-empresa/estado/{id_estado}', [EmpresaController::class, 'buscar_ciudad'])->name('admin.empresa.buscar_ciudad');
Route::post('/crear-empresa/create', [EmpresaController::class, 'store'])->name('admin.empresa.store');


Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    //rutas para configuraciones
    Route::get('/admin/configuracion', [EmpresaController::class, 'edit'])->name('admin.configuracion.edit');
    Route::get('/admin/configuracion/pais/{id_pais}', [EmpresaController::class, 'buscar_estado'])->name('admin.configuracion.empresa.buscar_estado');
    Route::get('/admin/configuracion/estado/{id_estado}', [EmpresaController::class, 'buscar_ciudad'])->name('admin.configuracion.empresa.buscar_ciudad');
    Route::put('/admin/configuracion/{id}', [EmpresaController::class, 'update'])->name('admin.configuracion.update');

    //rutas para roles
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::post('/admin/roles/create', [RoleController::class, 'store'])->name('admin.roles.store');
    Route::get('/admin/roles/{id}', [RoleController::class, 'show'])->name('admin.roles.show');
    Route::get('/admin/roles/{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');

    //rutas para usuarios
    Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('admin.usuarios.index');
    Route::get('/admin/usuarios/create', [UsuarioController::class, 'create'])->name('admin.usuarios.create');
    Route::post('/admin/usuarios/create', [UsuarioController::class, 'store'])->name('admin.usuarios.store');
    Route::get('/admin/usuarios/{id}', [UsuarioController::class, 'show'])->name('admin.usuarios.show');
    Route::get('/admin/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('admin.usuarios.edit');
    Route::put('/admin/usuarios/{id}', [UsuarioController::class, 'update'])->name('admin.usuarios.update');
    Route::delete('/admin/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy');

    //rutas para categorias
    Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('admin.categorias.index');
    Route::get('/admin/categorias/create', [CategoriaController::class, 'create'])->name('admin.categorias.create');
    Route::post('/admin/categorias/create', [CategoriaController::class, 'store'])->name('admin.categorias.store');
    Route::get('/admin/categorias/{id}', [CategoriaController::class, 'show'])->name('admin.categorias.show');
    Route::get('/admin/categorias/{id}/edit', [CategoriaController::class, 'edit'])->name('admin.categorias.edit');
    Route::put('/admin/categorias/{id}', [CategoriaController::class, 'update'])->name('admin.categorias.update');
    Route::delete('/admin/categorias/{id}', [CategoriaController::class, 'destroy'])->name('admin.categorias.destroy');

    //rutas para productos
    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('admin.productos.index');
    Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos/create', [ProductoController::class, 'store'])->name('admin.productos.store');
    Route::get('/admin/productos/{id}', [ProductoController::class, 'show'])->name('admin.productos.show');
    Route::get('/admin/productos/{id}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/{id}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');

    //rutas para proveedores
    Route::get('/admin/proveedores', [ProveedorController::class, 'index'])->name('admin.proveedores.index');
    Route::get('/admin/proveedores/create', [ProveedorController::class, 'create'])->name('admin.proveedores.create');
    Route::post('/admin/proveedores/create', [ProveedorController::class, 'store'])->name('admin.proveedores.store');
    Route::get('/admin/proveedores/{id}', [ProveedorController::class, 'show'])->name('admin.proveedores.show');
    Route::get('/admin/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('admin.proveedores.edit');
    Route::put('/admin/proveedores/{id}', [ProveedorController::class, 'update'])->name('admin.proveedores.update');
    Route::delete('/admin/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('admin.proveedores.destroy');

    //rutas para Compras
    Route::get('/admin/compras', [CompraController::class, 'index'])->name('admin.compras.index');
    Route::get('/admin/compras/create', [CompraController::class, 'create'])->name('admin.compras.create');
    Route::post('/admin/compras/create', [CompraController::class, 'store'])->name('admin.compras.store');
    Route::get('/admin/compras/{id}', [CompraController::class, 'show'])->name('admin.compras.show');
    Route::get('/admin/compras/{id}/edit', [CompraController::class, 'edit'])->name('admin.compras.edit');
    Route::put('/admin/compras/{id}', [CompraController::class, 'update'])->name('admin.compras.update');
    Route::delete('/admin/compras/{id}', [CompraController::class, 'destroy'])->name('admin.compras.destroy');

    //rutas para tmp compras
    Route::post('/admin/compras/create/tmp', [TmpCompraController::class, 'tmp_compras'])->name('admin.compras.tmp_compras');
    Route::delete('/admin/compras/create/tmp/{id}', [TmpCompraController::class, 'destroy'])->name('admin.compras.tmp_compras.destroy');

    // Rutas para detalle de las compras
    // Route::post('/admin/compras/detalle/create', [DetalleCompraController::class, 'store'])->name('admin.detalle.compras.store');
    Route::post('/admin/compras/detalle/create', [DetalleCompraController::class, 'store'])->name('admin.detalle.compras.store');


    Route::delete('/admin/compras/detalle/{id}', [DetalleCompraController::class, 'destroy'])->name('admin.detalle.compras.destroy');


});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

