<?php

use App\Models\TaxaComissoes;
use Illuminate\Support\Facades\Route;

function atualizarUsuarios()
{
    $mysql = conectaTabela();
    $dados = ($mysql->query("SELECT * FROM `usuarios`"))->fetch_all(MYSQLI_ASSOC);

    foreach ($dados as $dado) {
        try {
        (new \App\Models\User())->newQuery()
            ->create([
                'id' => $dado['id'],
                'name' => $dado['nome'],
                'email' => $dado['email'],
                'password' => $dado['senha'],
                'tipo' => $dado['tipo']
            ]);

        $meta = (new \App\Models\UserMeta())->newQuery();

        $meta->create([
            'users_id' => $dado['id'],
            'meta' => 'celular', 'value' => $dado['celular']]);
        $meta->create([
            'users_id' => $dado['id'],
            'meta' => 'rg', 'value' => $dado['rg']]);
        $meta->create([
            'users_id' => $dado['id'],
            'meta' => 'cpf', 'value' => $dado['cpf']]);
        $meta->create([
            'users_id' => $dado['id'],
            'meta' => 'endereco', 'value' => $dado['endereco']]);

        $comissao = (new TaxaComissoes())->newQuery();
        $comissao->create([
            'user_id' => $dado['id'],
            'taxa' => $dado['comissao']]);
        } catch (\Illuminate\Database\QueryException $exception) {}
    }
}
