<?php

use App\Http\Controllers\Admin\Integracoes\EldeltecController;
use Illuminate\Support\Facades\Route;

Route::name('admin.integracoes.')
    ->namespace('Integracoes')
    ->prefix('integracoes')
    ->group(function () {
        Route::resource('historico', 'HistoricoController');
        Route::resource('arquivo', 'ArquivoController');

        Route::name('eldeltec.')
            ->prefix('eldeltec')
            ->group(function () {
                Route::get('page', [EldeltecController::class, 'index'])->name('index');
                Route::get('integrar', [EldeltecController::class, 'integrar'])->name('integrar');
            });
    });
