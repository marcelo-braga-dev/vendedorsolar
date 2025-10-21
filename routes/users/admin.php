<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth', 'auth.admin'],
    'namespace' => 'App\Http\Controllers\Admin',
], function () {

    include_once 'admin/produtos.php';
    include_once 'admin/usuarios.php';
    include_once 'admin/fornecedores.php';
    include_once 'admin/orcamentos.php';
    include_once 'admin/integracoes.php';
    include_once 'admin/financeiro.php';
    include_once 'admin/precificacao.php';
    include_once 'admin/configuracoes.php';
    include_once 'admin/leads.php';
    include_once 'admin/perfil.php';
    include_once 'admin/dashboard.php';
    include_once 'admin/contratos.php';
}
);
