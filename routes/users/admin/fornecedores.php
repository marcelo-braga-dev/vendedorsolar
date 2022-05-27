<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')
    ->namespace('Fornecedores')
    ->group(function () {
        Route::resource('fornecedores', 'FornecedoresController');
    });
