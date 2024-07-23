<?php

use Illuminate\Support\Facades\Route;

Route::prefix('usuarios')
    ->name('admin.usuarios.')
    ->namespace('Usuarios')
    ->group(function () {
        Route::resource('vendedores', 'VendedoresController');
        Route::resource('admins', 'AdminController');
        Route::resource('admins-vendedores', 'AdminVendedorController');
        Route::resource('alterar-senha', 'AlterarSenhaController');
    });

Route::prefix('usuarios')
    ->name('admin.usuarios.vendedor.')
    ->namespace('Usuarios')
    ->group(function () {
        Route::get('vendedor/{id}/clientes', 'ClientesVendedorController@index')->name('clientes');
        Route::resource('clientes', 'ClientesVendedorController');
    });
