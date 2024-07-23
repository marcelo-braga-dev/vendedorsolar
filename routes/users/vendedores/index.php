<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth', 'auth.vendedor'],
    'namespace' => 'App\Http\Controllers\Vendedor',
], function () {
    include_once 'orcamentos.php';
    include_once 'clientes.php';
    include_once 'perfil.php';
    include_once 'mensagens.php';
    include_once 'financeiro.php';
    include_once 'visitas.php';
    include_once 'contratos.php';
}
);
