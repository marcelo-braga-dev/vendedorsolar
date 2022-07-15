<?php

use Illuminate\Support\Facades\Route;

Route::name('vendedor.')
    ->namespace('Visitas')
    ->group(function () {
        Route::resource('visitas', 'VisitasController');
    });
