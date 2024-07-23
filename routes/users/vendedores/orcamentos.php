<?php

use Illuminate\Support\Facades\Route;

// Orcamentos
Route::name('vendedor.')
    ->namespace('Orcamentos')
    ->group(function () {
        Route::resource('orcamento', 'OrcamentosController');
    });

// Vistoria
Route::prefix('orcamento')
    ->name('vendedor.orcamento.')
    ->namespace('Orcamentos')
    ->group(function () {
        Route::resource('vistoria', 'VistoriaController');
    });

// Aprovacao
Route::prefix('orcamento')
    ->name('vendedor.orcamento.')
    ->namespace('Orcamentos')
    ->group(function () {
        Route::resource('aprovacao', 'AprovacaoController');
    });

// Dimensionamento Convencional
Route::prefix('orcamentos/dimensionamento/convencional')
    ->name('vendedor.dimensionamento.convencional.')
    ->namespace('Orcamentos')
    ->group(function () {

        Route::get('', 'DimenConvencionalController@index')
            ->name('index');

        Route::get('store', 'DimenConvencionalController@create')
            ->name('create');

        Route::post('store', 'DimenConvencionalController@store')
            ->name('store');

        Route::get('kits', 'DimenConvencionalController@create')
            ->name('kits');
    });

// Dimensionamento Demanda
Route::prefix('orcamentos/dimensionamento/demanda')
    ->name('vendedor.dimensionamento.demanda.')
    ->namespace('Orcamentos')
    ->group(function () {
        Route::get('kits', 'DimenDemandaController@create')
            ->name('kits');

        Route::get('', 'DimenDemandaController@index')
            ->name('index');

        Route::get('store', 'DimenDemandaController@create')
            ->name('get-kits');

        Route::post('store', 'DimenDemandaController@store')
            ->name('store');
    });
