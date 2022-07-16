<?php

namespace App\Models;

use App\src\Clientes\Status\StatusEmitidoOrcamentoCliente;
use App\src\Orcamentos\ChavesOrcamentos;
use App\src\Orcamentos\Status\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orcamentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'clientes_id',
        'preco_cliente',
        'status',
        'geracao',
        'cidade',
        'trafo',
        'token'
    ];

    public function alterarStatus($id, Status $status)
    {
        $this->newQuery()
            ->find($id)->update(['status' => $status->getStatus()]);
    }

    public function clientes()
    {
        return $this->belongs(Clientes::class);
    }

    public function cadastrar($dados): int
    {
        $orcamento = $this->newQuery()
            ->create([
                'users_id' => id_usuario_atual(),
                'clientes_id' => $dados->getCliente(),
                'preco_cliente' => $dados->getPrecoCliente(),
                'status' => $dados->getStatus(),
                'geracao' => $dados->getGeracao(),
                'cidade' => $dados->getCidade(),
                'trafo' => $dados->getTrafo(),
                'token' => uniqid()
            ]);

        modalSucesso('Orçamento criado com sucesso');

        $this->cadastrarKits($orcamento->id, $dados);
        $this->metas($orcamento->id, $dados);
        $this->atualizarStatusCliente($dados->getCliente());

        return $orcamento->id;
    }

    private function atualizarStatusCliente($id)
    {
        (new StatusEmitidoOrcamentoCliente())->atualizarStatus($id);
    }

    private function cadastrarKits($idOrcamento, $dados)
    {
        $orcamentoKits = new OrcamentoKits();
        $orcamentoKits->newQuery()
            ->create([
                'orcamentos_id' => $idOrcamento,
                'kits_id' => $dados->getKitId(),
                'qtd_kits' => $dados->getQtdKits(),
                'preco_cliente' => $dados->getPrecoCliente(),
                'preco_fornecedor' => 1,
                'taxa_comissao' => $dados->getTaxaComissao()
            ]);
    }

    private function metas($id, $dados)
    {
        $chaves = new ChavesOrcamentos();
        $metas = new OrcamentosMetas();
        $metas->criar($id, $chaves->getConsumo(), $dados->getConsumo());
        $metas->criar($id, $chaves->getConsumoPonta(), $dados->getConsumoPonta());
        $metas->criar($id, $chaves->getConsumoForaPonta(), $dados->getConsumoForaPonta());
        $metas->criar($id, $chaves->getDemanda(), $dados->getDemandaContratada());
        $metas->criar($id, $chaves->getPermitirEdicao(), 1);
        $metas->criar($id, $chaves->getEstrutura(), $dados->getEstrutura());
        $metas->criar($id, $chaves->getTensao(), $dados->getTensao());
        $metas->criar($id, $chaves->getOrientacao(), $dados->getOrientacao());
    }
}
