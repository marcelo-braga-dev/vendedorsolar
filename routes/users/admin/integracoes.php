<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.integracoes.')
    ->namespace('Integracoes')
    ->prefix('integracoes')
    ->group(function () {
        Route::resource('historico', 'HistoricoController');
        Route::resource('chaves', 'ChavesController');
        Route::resource('arquivo', 'ArquivoController');

        Route::get('aldo', 'AldoController@index')
            ->name('aldo.index');

        Route::get('aldo/pesquisar', 'AldoController@pesquisar')
            ->name('aldo.pesquisar');

        Route::get('aldo/integrar', 'AldoController@integrar')
            ->name('aldo.integrar');

        Route::put('aldo/store', 'AldoController@store')
            ->name('aldo.store');

        Route::resource('eldeltec', \App\Http\Controllers\Admin\Integracoes\EldeltecController::class);
    });
