<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.configs.')
    ->namespace('Configuracoes')
    ->group(function () {
        Route::resource('dimensionamento', 'DimensionamentosController');
        Route::resource('bancos', 'BancosController');
        Route::resource('backup', 'BackupController');
        Route::resource('concessionarias', 'ConcessionariasController');
        Route::resource('sistema', 'SistemaController');
    });
