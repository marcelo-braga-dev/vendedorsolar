<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.precificacao.')
    ->namespace('Precificacoes')
    ->group(function () {
        Route::resource('margem-principal', 'MargemPrincipalController');
        Route::resource('estado', 'MargemEstadoController');
        Route::resource('vendedor', 'MargemPorVendedorController');
        Route::resource('estrutura', 'MargemPorEstruturaController');
        Route::resource('fornecedor', 'MargemFornecedorController');
    });
