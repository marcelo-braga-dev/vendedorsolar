<?php

use App\Http\Controllers\Admin\Contratos\ContratosController;
use App\Http\Controllers\Admin\Contratos\GerarPdfContratoController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->group(function () {
        Route::resource('contratos', ContratosController::class);
        Route::post('contratos-pdf', GerarPdfContratoController::class)->name('contratos.pdf');
    });
