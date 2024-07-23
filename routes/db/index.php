<?php

use Illuminate\Support\Facades\Route;


Route::get('atualizar-db', function (\Illuminate\Http\Request $request) {
    echo 'INICIO';
    include 'conexao.php';
    include 'funcoesIntegracao.php';
    include 'usuarios.php';
    include 'clientes.php';
    include 'orcamentos.php';
    atualizarUsuarios();
    atualizarClientes();
    echo '<br>FIM';
});

Route::get('info-orcamento', function (\Illuminate\Http\Request $request) {
    echo 'INICIO<br>';
    include 'atualizacao/info-orcamento.php';
    echo '<br>FIM';
});

Route::get('importar-kits', function (\Illuminate\Http\Request $request) {
    echo 'INICIO<br>';
    include 'conexao.php';
    include 'importar-kits.php';
    cadastrarKits();
    echo '<br>FIM';
});
