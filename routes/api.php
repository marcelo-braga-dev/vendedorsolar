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

Route::get('admin/fornecedores/alterar-status-kits', [\App\Http\Controllers\Admin\Produtos\StatusKitsController::class, 'update'])
->name('api.fornecedores.alterar-status-kits');

// Visualizar PDF Orcamento
Route::get('orcamento/{token}', [App\Http\Controllers\Api\OrcamentoApiController::class, 'show'])
    ->name('api.orcamento.show');

Route::get('endereco/id', [App\Http\Controllers\Api\EnderecoController::class, 'getIdCidadeEstado'])
    ->name('api.endereco.id.cidade.estado');

Route::post('lead', [App\Http\Controllers\Api\LeadsController::class, 'store'])
    ->name('api.leads');
