<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

// PDF do orcamento
Route::post(
    'orcamento/gerar-pdf',
    [App\Http\Controllers\PDFOrcamentoController::class, 'index']
)->name('orcamento.pdf');

// html select cidades estados
Route::get('cidades-estados', function (\Illuminate\Http\Request $request) {

    $cidadesEstados = new \App\Models\CidadesEstados();
    $dados = $cidadesEstados->newQuery()
        ->where('sigla', '=', $request->estado)
        ->orderBy('cidade', 'ASC')
        ->get();

    $html = '<option value="">Selecione a Cidade</option>';

    foreach ($dados as $dado) {
        $selected = $dado->cidade == $request->cidade ? 'selected' : '';

        $html .= "<option value='$dado->id' $selected> $dado->cidade </option>";
    }

    return $html;
})->name('cidades-estados');

Route::get('select-estados', function (\Illuminate\Http\Request $request) {

    $cidadesEstados = new \App\Models\CidadesEstados();
    $dados = $cidadesEstados->newQuery()
        ->orderBy('sigla', 'ASC')
        ->distinct()
        ->get(['estado', 'sigla']);

    $html = '<option value=""></option>';

    foreach ($dados as $dado) {
        $selected = $dado->sigla == $request->estado ? 'selected' : '';
        $html .= "<option value='$dado->sigla' $selected>$dado->estado</option>";
    }
    return $html;
})->name('estados');
