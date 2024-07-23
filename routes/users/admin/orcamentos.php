<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->namespace('Orcamentos')
    ->group(function () {
        Route::resource('orcamentos', 'OrcamentosController');
    });

Route::name('admin.orcamento.')
    ->namespace('Orcamentos')
    ->group(function () {
        Route::resource('vistoria', 'VistoriaController');
        Route::resource('aprovacao', 'AprovacaoController');
        Route::resource('status', 'StatusController');
    });
