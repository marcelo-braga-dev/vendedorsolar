<?php

namespace App\Models;

use App\Http\Requests\FormCadastroKitRequest;
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
        'observacoes'
    ];

    public function cadastrarKit(Kit $dados)
    {
        $this->dados($dados, $this);
    }

    public function atualizarKit($id, Kit $dados)
    {
        $class = $this->newQuery()->find($id);

        $class->status_fornecedor = $dados->getStatusFornecedor();
        $this->dados($dados, $class);
    }

    private function dados($dados, $class)
    {
        try {
            $this->newQuery()->updateOrCreate(
                ['sku' => $dados->getSku()],
                [
                    'modelo' => $dados->getModelo(),
                    'marca_inversor' => $dados->getMarcaInversor(),
                    'potencia_inversor' => $dados->getPotenciaInversor(),
                    'marca_painel' => $dados->getMarcaPainel(),
                    'potencia_painel' => $dados->getPotenciaPainel(),
                    'potencia_kit' => $dados->getPotenciaKit(),
                    'fornecedor' => $dados->getFornecedor(),
                    'preco_fornecedor' => $dados->getPrecoFornecedor(),
                    'estrutura' => $dados->getEstrutura(),
                    'tensao' => $dados->getTensao(),
                    'produtos' => $dados->getProdutos(),
                    'observacoes' => $dados->getObservacoes(),
                    'margem' => $dados->getMargem(),
                ]);
        } catch (QueryException $exception) {
            throw new \DomainException('Por favor, Verifique as informações inseridas.');
        }
    }

    public function atualizarPrecosPeloSKU(string $sku, float $precoFornecedor)
    {
        $this->where('sku', $sku)
            ->update([
                'preco_fornecedor' => $precoFornecedor,
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
            ['marca_painel', '=', $painel]
        ])->update(['status' => $status]);
    }
}
