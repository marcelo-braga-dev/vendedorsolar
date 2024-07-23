<?php

use Illuminate\Support\Facades\Route;

Route::prefix('usuario')
    ->name('vendedor.')
    ->namespace('Perfil')
    ->group(function () {
        Route::resource('perfil', 'PerfilController');
        Route::resource('senha', 'SenhaController');
    });
