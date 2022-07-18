<?php

use Illuminate\Support\Facades\Route;

function orcamentoKit($orcamento, $dado): void
{
    $meta = (new \App\Models\OrcamentosMetas())->newQuery();

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'orientacao', 'value' => 'x']);

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'tensao', 'value' => $dado['tensao']]);

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'estrutura', 'value' => $dado['tipo-estrutura']]);

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'permitir_edicao', 'value' => 1]);

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'demanda', 'value' => null]);

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'consumo_fora_ponta', 'value' => null]);

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'consumo_ponta', 'value' => null]);

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'consumo', 'value' => $dado['media-consumo']]);

    $meta->create(['orcamentos_id' => $orcamento->id,
        'meta_key' => 'rede', 'value' => $dado['tipo-rede']]);
}

function orcamento($dado)
{
    $trafo = $dado['trafo'];
    if ($trafo == '?' || empty($trafo)) $trafo = 123;

    return (new \App\Models\Orcamentos())->newQuery()
        ->create([
            'users_id' => $dado['id-repre'],
            'clientes_id' => $dado['id-cliente'],
            'preco_cliente' => convert_money_float($dado['preco-cliente']),
            'status' => 'novo',
            'geracao' => $dado['geracao'] ?? 1,
            'cidade' => getIdLocalidadeIntegracao($dado['cidade'], $dado['estado']),
            'trafo' => $trafo,
            'token' => uniqid(),
        ]);
}

function getPotenciaPainel($linha, $mysql)
{
    $cod = preg_replace('/[^a-z]/', '', $linha);
    try {
        $dados = ($mysql->query("SELECT * FROM `linha_painel` where `codigo` = '$cod'"))
            ->fetch_all(MYSQLI_ASSOC);
        return $dados[0]['potencia'];
    } catch (Error $exception) {
        print_pre($exception->getMessage());
    }
}

function cadastrarKit($dados, $mysql)
{
    $potenciaPainel = getPotenciaPainel($dados['linha'], $mysql);

    if (empty($potenciaPainel)) print_pre('Potencia nao encontrada');
    try {
         return (new \App\Models\Kits())->newQuery()
            ->create([
                'sku' => $dados['sku'],
                'modelo' => $dados['modelo-kit'],
                'potencia_kit' => $dados['potencia-kit'],
                'marca_inversor' => $dados['inversor'],
                'marca_painel' => $dados['painel'],
                'potencia_inversor' => 1,
                'potencia_painel' => $potenciaPainel,
                'margem' => $dados['margem'],
                'preco_cliente' => $dados['preco-kit-cliente'],
                'preco_fornecedor' => $dados['preco-kit-empresa'],
                'fornecedor' => $dados['fornecedor'],
                'tensao' => $dados['tensao'],
                'estrutura' => $dados['estrutura'],
                'produtos' => $dados['produtos'],
                'status' => 0,
                'status_fornecedor	' => 0
            ]);
    } catch (\Illuminate\Database\QueryException $exception) {
        print_pre($exception->getMessage());
    }
}


function atualizarOrcamentos() {
    $mysql = conectaTabela();
    $dados = ($mysql->query("SELECT * FROM `orcamentos`"))->fetch_all(MYSQLI_ASSOC);

    function getKit($id, $mysql)
    {
        try {
            $dados = $mysql->query("SELECT * FROM `kits` WHERE `id` = $id")->fetch_all(MYSQLI_ASSOC);
            if (empty($dados)) throw new Error();
            return cadastrarKit($dados[0], $mysql);
        } catch (Error $exception) {//|\Illuminate\Database\QueryException
            return [
                'id' => 1,
                'preco_cliente' => 1,
                'preco_fornecedor' => 1
            ];
        }
    }

    foreach ($dados as $dado) {
        $orcamento = orcamento($dado);

        orcamentoKit($orcamento, $dado);
        $kit = getKit($dado['id-produto'], $mysql);

        $orcamentoKits = (new \App\Models\OrcamentoKits())->newQuery();
        $orcamentoKits->create([
            'orcamentos_id' => $orcamento->id,
            'kits_id' => $kit['id'],
            'preco_cliente' => $kit['preco_cliente'],
            'preco_fornecedor' => $kit['preco_fornecedor'],
            'qtd_kits' => 1,
            'taxa_comissao' => $dado['taxa-comissao'],
        ]);
    }
}




