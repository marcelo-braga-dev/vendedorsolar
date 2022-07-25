<?php

use Illuminate\Support\Facades\Route;

function atualizarClientes()
{
    $mysql = conectaTabela();
    $vendedores = (new \App\Models\User())->newQuery()->get();

    foreach ($vendedores as $vendedor) {
        try {
            $dadosClientes = $mysql
                ->query("SELECT * FROM `{$vendedor->id}` ORDER BY `id` DESC")
                ->fetch_all(MYSQLI_ASSOC);

            foreach ($dadosClientes as $dadosCliente) {
                $nome = $dadosCliente['nome'];
                if (empty($nome)) $nome = $dadosCliente['razao_social'];

                $cliente = (new \App\Models\Clientes())->newQuery()
                    ->create([
                        'nome' => $nome,
                        'users_id' => $vendedor->id,
                        'cidades_estados_id' => getIdLocalidadeIntegracao($dadosCliente['cidade'], $dadosCliente['estado']),
                        'status' => 'novo'
                    ]);

                $meta = (new \App\Models\ClientesMetas())->newQuery();
                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'cpf', 'value' => $dadosCliente['cpf']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'rg', 'value' => $dadosCliente['rg']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'cnpj', 'value' => $dadosCliente['cnpj']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'razao_social', 'value' => $dadosCliente['razao_social']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'inscricao_social', 'value' => $dadosCliente['inscricao_estadual']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'nome_fantasia', 'value' => $dadosCliente['nome_fantasia']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'celular', 'value' => $dadosCliente['celular']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'telefone', 'value' => $dadosCliente['telefone']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'email', 'value' => $dadosCliente['email']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'cep', 'value' => $dadosCliente['cep']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'endereco', 'value' => $dadosCliente['endereco']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'complemento', 'value' => null]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'numero', 'value' => $dadosCliente['numero']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'bairro', 'value' => $dadosCliente['bairro']]);

                $meta->create(['cliente_id' => $cliente->id,
                    'meta' => 'whatsapp', 'value' => $dadosCliente['whatsapp']]);

                cadastraOrcamento($cliente->id, $dadosCliente['id'], $vendedor->id);
            }
        } catch (Error $exception) {
        }
    }
}
