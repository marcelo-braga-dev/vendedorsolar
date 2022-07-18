<?php

use Illuminate\Support\Facades\Route;

include 'conexao.php';
include 'funcoesIntegracao.php';
include 'usuarios.php';
include 'clientes.php';
include 'orcamentos.php';

Route::get('atualizar-db', function (\Illuminate\Http\Request $request) {
    echo 'INICIO';
    atualizarUsuarios();
    atualizarClientes();
    atualizarOrcamentos();
    echo '<br>FIM';
});
