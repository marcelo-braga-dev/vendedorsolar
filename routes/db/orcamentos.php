<?php

use Illuminate\Support\Facades\Route;

function cadastraOrcamento($clienteLaravel, $cliente, $vendedor)
{
    $mysql = conectaTabela();
    $orcamentos = ($mysql->query("SELECT * FROM `orcamentos` WHERE `id-cliente` = $cliente
                             AND `id-repre` = $vendedor"))->fetch_all(MYSQLI_ASSOC);

    foreach ($orcamentos as $dado) {
        $orcamento = criaOrcamentoLaravel($dado, $clienteLaravel, $vendedor);

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
function converteData($data)
{
    $data_brasil = DateTime::createFromFormat('d/m/y H:i', $data);
    print_pre($data_brasil->format('Y-m-d H:i:00'));;
}
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

function criaOrcamentoLaravel($dado, $cliente, $vendedor)
{
    $trafo = $dado['trafo'];
    if ($trafo == '?' || empty($trafo)) $trafo = null;

    return (new \App\Models\Orcamentos())->newQuery()
        ->create([
            'users_id' => $vendedor,
            'clientes_id' => $cliente,
            'preco_cliente' => convert_money_float($dado['preco-cliente']),
            'status' => $dado['status'],
            'geracao' => $dado['geracao'] ?? 1,
            'cidade' => getIdLocalidadeIntegracao($dado['cidade'], $dado['estado']),
            'trafo' => $trafo,
            'token' => uniqid(),
            'created_at' => converteData($dado['data-criacao']),
            'updated_at' => converteData($dado['data-criacao']),
        ]);
}

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




