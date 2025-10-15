<?php

use App\Http\Controllers\Vendedor\Contratos\ContratosController;
use Illuminate\Support\Facades\Route;

Route::name('vendedor.')
    ->namespace('Contratos')
    ->group(function () {
        Route::resource('contratos', ContratosController::class);
    });
