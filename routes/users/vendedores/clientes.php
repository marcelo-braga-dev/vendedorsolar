<?php

use Illuminate\Support\Facades\Route;

Route::name('vendedor.')
    ->namespace('Clientes')
    ->group(function () {
        Route::resource('clientes', 'ClientesController');
        Route::resource('leads', 'LeadsController');
    });
