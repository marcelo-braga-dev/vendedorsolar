<?php
use Illuminate\Support\Facades\Route;

Route::prefix('usuario')
    ->name('admin.')
    ->namespace('Perfil')
    ->group(function () {
        Route::resource('perfil', 'PerfilController');
        Route::resource('senha', 'SenhaController');
    });
