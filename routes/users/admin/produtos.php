<?php

use Illuminate\Support\Facades\Route;

Route::prefix('produtos')
    ->name('admin.produtos.')
    ->namespace('Produtos')
    ->group(function () {
        Route::resource('kits', 'KitsController');
        Route::resource('inversores', 'InversoresController');
        Route::resource('paineis', 'PaineisController');
        Route::resource('trafos', 'TrafosController');
        Route::resource('status-kits', 'StatusKitsController');
    });
