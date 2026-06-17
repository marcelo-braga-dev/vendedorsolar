<?php

namespace App\Models;

use App\src\Produtos\Kit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Kits extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'modelo',
        'potencia_kit',
        'marca_inversor',
        'marca_painel',
        'potencia_painel',
        'potencia_inversor',
        'margem',
        'potencia',
        'preco_fornecedor',
        'status',
        'status_fornecedor',
        'fornecedor',
        'tensao',
        'estrutura',
        'produtos',
        'complementos',
        'observacoes',
    ];

    /**
     * Insere ou atualiza um lote de kits em uma única query.
     *
     * Colunas de controle (status, status_fornecedor, created_at) são preservadas
     * nos registros já existentes; apenas os dados do produto são atualizados.
     */
    public function bulkUpsert(array $rows): void
    {
        if (empty($rows)) {
            return;
        }

        $this->upsert(
            $rows,
            ['sku'],
            [
                'modelo',
                'marca_inversor',
                'potencia_inversor',
                'marca_painel',
                'potencia_painel',
                'potencia_kit',
                'fornecedor',
                'preco_fornecedor',
                'estrutura',
                'tensao',
                'produtos',
                'observacoes',
                'margem',
                'status_fornecedor',
                'updated_at',
            ]
        );
    }

    public function cadastrarKit(Kit $dados)
    {
        $this->upsertKit($dados);
    }

    public function atualizarKit($id, Kit $dados)
    {
        $this->upsertKit($dados);
    }

    private function upsertKit(Kit $dados): void
    {
        try {
            $this->newQuery()->updateOrCreate(
                ['sku' => $dados->getSku()],
                [
                    'modelo'            => $dados->getModelo(),
                    'marca_inversor'    => $dados->getMarcaInversor(),
                    'potencia_inversor' => $dados->getPotenciaInversor(),
                    'marca_painel'      => $dados->getMarcaPainel(),
                    'potencia_painel'   => $dados->getPotenciaPainel(),
                    'potencia_kit'      => $dados->getPotenciaKit(),
                    'fornecedor'        => $dados->getFornecedor(),
                    'preco_fornecedor'  => $dados->getPrecoFornecedor(),
                    'estrutura'         => $dados->getEstrutura(),
                    'tensao'            => $dados->getTensao(),
                    'produtos'          => $dados->getProdutos(),
                    'observacoes'       => $dados->getObservacoes(),
                    'margem'            => $dados->getMargem(),
                ]
            );
        } catch (QueryException $e) {
            throw new \DomainException('Por favor, verifique as informações inseridas.');
        }
    }

    public function atualizarPrecosPeloSKU(string $sku, float $precoFornecedor)
    {
        $this->where('sku', $sku)
            ->update([
                'preco_fornecedor'  => $precoFornecedor,
                'status_fornecedor' => 1,
            ]);
    }

    public function fornecedor(int $id)
    {
        return $this->newQuery()
            ->where('fornecedor', '=', $id)
            ->distinct()
            ->orderBy('potencia_painel')
            ->get(['marca_inversor', 'marca_painel', 'potencia_painel', 'status']);
    }

    public function updateStatus(int $fornecedor, int $potencia, int $inversor, int $painel, string $status): void
    {
        if ($status === 'false') $status = false;
        if ($status === 'true') $status = true;

        $this->newQuery()->where([
            ['fornecedor', '=', $fornecedor],
            ['potencia_painel', '=', $potencia],
            ['marca_inversor', '=', $inversor],
            ['marca_painel', '=', $painel],
        ])->update(['status' => $status]);
    }

    public function marcaInversorRel()
    {
        return $this->belongsTo(Produtos::class, 'marca_inversor');
    }

    public function marcaPainelRel()
    {
        return $this->belongsTo(Produtos::class, 'marca_painel');
    }

    public function estruturaRel()
    {
        return $this->belongsTo(Estruturas::class, 'estrutura');
    }

    public function fornecedorRel()
    {
        return $this->belongsTo(Fornecedores::class, 'fornecedor');
    }
}
