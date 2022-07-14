<?php

use Illuminate\Support\Facades\Route;

Route::prefix('usuarios')
    ->name('admin.usuarios.')
    ->namespace('Usuarios')
    ->group(function () {
        Route::resource('vendedores', 'VendedoresController');
        Route::resource('admins', 'AdminController');
    });

Route::prefix('usuarios')
    ->name('admin.usuarios.vendedor.')
    ->namespace('Usuarios')
    ->group(function () {
        Route::resource('clientes', 'ClientesVendedorController');
    });
