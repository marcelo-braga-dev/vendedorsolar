<?php

use Illuminate\Support\Facades\Route;

Route::name('vendedor.')
    ->namespace('Mensagens')
    ->group(function () {
        Route::resource('mensagens', 'MensagensController');
        Route::resource('alertas', 'AvisosController');
    });
