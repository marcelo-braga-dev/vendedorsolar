<?php

use Illuminate\Support\Facades\Route;

function atualizarClientes()
{
    $vendedores = (new \App\Models\User())->newQuery()->get();

    foreach ($vendedores as $vendedor) {
        $mysql = conectaTabela();

        $resultado = $mysql->query("SELECT * FROM `{$vendedor->id}` ORDER BY `id` DESC");
        $dados = $resultado->fetch_all(MYSQLI_ASSOC);

        foreach ($dados as $dado) {
            $nome = $dado['nome'];
            if (empty($nome)) $nome = $dado['razao_social'];

            $cliente = (new \App\Models\Clientes())->newQuery()
                ->create([
                    'nome' => $nome,
                    'users_id' => $vendedor->id,
                    'cidades_estados_id' => getIdLocalidadeIntegracao($dado['cidade'], $dado['estado']),
                    'status' => 'novo'
                ]);

            $meta = (new \App\Models\ClientesMetas())->newQuery();
            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'cpf', 'value' => $dado['cpf']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'rg', 'value' => $dado['rg']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'cnpj', 'value' => $dado['cnpj']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'razao_social', 'value' => $dado['razao_social']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'inscricao_social', 'value' => $dado['inscricao_estadual']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'nome_fantasia', 'value' => $dado['nome_fantasia']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'celular', 'value' => $dado['celular']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'telefone', 'value' => $dado['telefone']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'email', 'value' => $dado['email']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'cep', 'value' => $dado['cep']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'endereco', 'value' => $dado['endereco']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'complemento', 'value' => null]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'numero', 'value' => $dado['numero']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'bairro', 'value' => $dado['bairro']]);

            $meta->create(['cliente_id' => $cliente->id,
                'meta' => 'whatsapp', 'value' => $dado['whatsapp']]);
        }
    }
}
