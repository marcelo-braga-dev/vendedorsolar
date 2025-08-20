<?php

use App\Http\Controllers\Admin\Orcamentos\OrcamentosController;
use App\Http\Controllers\Admin\Orcamentos\Servicos\GerarPdfServicoController;
use App\Http\Controllers\Admin\Orcamentos\Servicos\ServicosController;
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

// Servicos
Route::name('admin.')
    ->namespace('Orcamentos')
    ->group(function () {
        Route::resource('servicos', ServicosController::class);
        Route::post('servicos-pdf', GerarPdfServicoController::class)->name('servicos.pdf');
    });
