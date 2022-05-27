<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'kits_id',
        'clientes_id',
        'taxa_comissao',
        'preco_cliente',
        'status',
        'cidade',
        'estrutura',
        'tensao',
        'trafo',
        'orientacao',
        'consumo',
        'anotacoes',
        'geracao',
        'token',
        'qtd_kits'
    ];

    public function clientes()
    {
        return $this->belongs(Clientes::class);
    }

    public function cadastrar($dados): int
    {
        $orcamento = $this->newQuery()
            ->create([
                'users_id' => id_usuario_atual(),
                'kits_id' => $dados->getKitId(),
                'cidade' => $dados->getCidade(),
                'geracao' => $dados->getGeracao(),
                'estrutura' => $dados->getEstrutura(),
                'tensao' => $dados->getTensao(),
                'orientacao' => $dados->getOrientacao(),
                'consumo' => $dados->getConsumo(),
                'clientes_id' => $dados->getCliente(),
                'taxa_comissao' => $dados->getTaxaComissao(),
                'preco_cliente' => $dados->getPrecoCliente(),
                'trafo' => $dados->getTrafo(),
                'status' => $dados->getStatus(),
                'token' => $dados->getToken(),
                'qtd_kits' => $dados->getQtdKits()
            ]);

        modalSucesso('Orçamento criado com sucesso');

        $this->cadastrarKits($orcamento->id, $dados->getKitId());
        $this->metas($orcamento->id, $dados);

        return $orcamento->id;
    }

    private function cadastrarKits($idOrcamento, $idKit)
    {
        $orcamentoKits = new OrcamentoKits();
        $orcamentoKits->newQuery()
            ->create([
                'orcamentos_id' => $idOrcamento,
                'kits_id' => $idKit
            ]);
    }

    private function metas($id, $dados)
    {
        $metas = new OrcamentosMetas();
        $metas->criar($id, 'consumo', $dados->getConsumo());
        $metas->criar($id, 'consumo_ponta', $dados->getConsumoPonta());
        $metas->criar($id, 'consumo_fora_ponta', $dados->getConsumoForaPonta());
    }
}
