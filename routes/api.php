<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Visualizar PDF Orcamento
Route::get('orcamento/{token}', [App\Http\Controllers\Api\OrcamentoApiController::class, 'show'])
    ->name('api.orcamento.show');

Route::get('endereco/id', [App\Http\Controllers\Api\EnderecoController::class, 'getIdCidadeEstado'])
    ->name('api.endereco.id.cidade.estado');

Route::post('lead', [App\Http\Controllers\Api\LeadsController::class, 'store'])
    ->name('api.leads');

// Integração com a loja online: sincronização de catálogo de produtos
Route::middleware('auth.loja_api')->prefix('v1/loja')->name('api.v1.loja.')->group(function () {
    Route::get('produtos', [App\Http\Controllers\Api\ProdutosLojaController::class, 'index'])
        ->name('produtos.index');

    Route::get('produtos/{sku}', [App\Http\Controllers\Api\ProdutosLojaController::class, 'show'])
        ->name('produtos.show');
});
