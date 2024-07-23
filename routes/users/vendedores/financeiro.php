<?php

use Illuminate\Support\Facades\Route;

Route::name('vendedor.financeiro.')
    ->namespace('Financeiros')
    ->group(function () {
        Route::resource('faturamento', 'FinanceiroController');
    });
