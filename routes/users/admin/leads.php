<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->namespace('Leads')
    ->group(function () {
        Route::resource('leads', 'LeadsController');
    });
