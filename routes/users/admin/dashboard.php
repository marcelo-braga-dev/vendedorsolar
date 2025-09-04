<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::name('admin.dashboard.')
    ->group(function () {
        Route::get('dashboard/financeiro', [DashboardController::class, 'financeiro'])->name('financeiro');
        Route::get('dashboard/vendas', [DashboardController::class, 'vendas'])->name('vendas');
        Route::get('dashboard/gestao', [DashboardController::class, 'gestao'])->name('gestao');
    });
