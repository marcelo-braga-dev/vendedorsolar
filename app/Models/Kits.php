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

    // protected $fillable = [
    //     'titulo',
    //     // 'sku',
    //     'inversor_id',
    //     'painel_id',
    //     'estrutura_id',
    //     'tipo_produto',
    //     // 'tensao',
    //     'preco_compra',
    //     'preco_venda',
    //     'items',
    //     'potencia_kit',
    //     'potencia_inversor',
    //     'potencia_modulo',
    //     'fase',
    //     'descricao',
    //     'status_distribuidora',
    //     'status',
    //     'estoque_disponivel',
    //     'hibrido',
    //     'estoque_disponivel_data'
    // ];

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
        $class->sku = $dados->getSku();
        $class->modelo = $dados->getModelo();
        $class->marca_inversor = $dados->getMarcaInversor();
        $class->potencia_inversor = $dados->getPotenciaInversor();
        $class->marca_painel = $dados->getMarcaPainel();
        $class->potencia_painel = $dados->getPotenciaPainel();
        $class->potencia_kit = $dados->getPotenciaKit();
        $class->fornecedor = $dados->getFornecedor();
        $class->preco_fornecedor = $dados->getPrecoFornecedor();
        $class->estrutura = $dados->getEstrutura();
        $class->tensao = $dados->getTensao();
        $class->produtos = $dados->getProdutos();
        $class->observacoes = $dados->getObservacoes();
        $class->margem = $dados->getMargem();

        try {
            $class->push();
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
