<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->namespace('Integracoes')
    ->prefix('integracoes')
    ->group(function () {

        Route::get('aldo', 'AldoController@index')
            ->name('integracoes.aldo.index');

        Route::get('aldo/pesquisar', 'AldoController@pesquisar')
            ->name('integracoes.aldo.pesquisar');

        Route::get('aldo/integrar', 'AldoController@integrar')
            ->name('integracoes.aldo.integrar');

        Route::put('aldo/store', 'AldoController@store')
            ->name('integracoes.aldo.store');
    });
