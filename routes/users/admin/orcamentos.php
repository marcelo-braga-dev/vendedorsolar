<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->namespace('Orcamentos')
    ->group(function () {

        Route::resource('orcamentos', 'OrcamentosController');

        // Route::get('orcamentos', 'OrcamentosController@index')
        //     ->name('orcamentos.index');

        // Route::get('orcamentos/{id}', 'OrcamentosController@show')
        //     ->name('orcamentos.show');

        // Route::put('orcamentos/{id}', 'OrcamentosController@update')
        //     ->name('orcamentos.update');
    });
