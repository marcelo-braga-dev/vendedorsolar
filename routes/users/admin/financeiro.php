<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.financeiro.')
    ->namespace('Financeiros')
    ->group(function () {
        Route::resource('comissao-venda', 'ComissaoVendaController');
        Route::resource('faturamento', 'FaturamentoController');
    });
