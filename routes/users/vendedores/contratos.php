<?php

use Illuminate\Support\Facades\Route;

Route::name('vendedor.')
    ->namespace('Contratos')
    ->group(function () {
        Route::resource('contratos', 'ContratosController');
    });
