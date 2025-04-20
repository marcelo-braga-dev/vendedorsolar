<?php

use App\Http\Controllers\Admin\Orcamentos\OrcamentosController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->group(function () {
        Route::resource('orcamentos', OrcamentosController::class);
    });

Route::name('admin.orcamento.')
    ->namespace('Orcamentos')
    ->group(function () {
        Route::resource('vistoria', 'VistoriaController');
        Route::resource('aprovacao', 'AprovacaoController');
        Route::resource('status', 'StatusController');
    });
