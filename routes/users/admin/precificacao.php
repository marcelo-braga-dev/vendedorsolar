<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.precificacao.')
    ->namespace('Precificacoes')
    ->group(function () {
        Route::resource('margem-principal', 'MargemPrincipalController');
    });

Route::name('admin.precificacao.')
    ->namespace('Precificacoes')
    ->group(function () {
        Route::resource('vendedor', 'MargemPorVendedorController');
    });

Route::name('admin.precificacao.')
    ->namespace('Precificacoes')
    ->group(function () {
        Route::resource('estrutura', 'MargemPorEstruturaController');
    });
