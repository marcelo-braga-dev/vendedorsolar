<?php

use Illuminate\Support\Facades\Route;

Route::name('vendedor.')
    ->group(function () {
        Route::resource('clientes', 'ClientesController');
    });
