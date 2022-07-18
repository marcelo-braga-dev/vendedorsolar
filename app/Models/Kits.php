<?php

namespace App\Models;

use App\Http\Requests\FormCadastroKitRequest;
use App\src\Produtos\Kit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kits extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'sku',
            'modelo',
            'potencia_kit',
            'marca_inversor',
            'marca_painel',
            'potencia_painel',
            'potencia_inversor',
            'margem',
            'potencia',
            'preco_cliente',
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
        $this->sku = $dados->getSku();
        $this->modelo = $dados->getModelo();
        $this->marca_inversor = $dados->getMarcaInversor();
        $this->potencia_inversor = $dados->getPotenciaInversor();
        $this->marca_painel = $dados->getMarcaPainel();
        $this->potencia_painel = $dados->getPotenciaPainel();
        $this->potencia_kit = $dados->getPotenciaKit();
        $this->fornecedor = $dados->getFornecedor();
        $this->preco_fornecedor = $dados->getPrecoFornecedor();
        $this->estrutura = $dados->getEstrutura();
        $this->tensao = $dados->getTensao();
        $this->produtos = $dados->getProdutos();
        $this->observacoes = $dados->getObservacoes();
        $this->preco_cliente = $dados->getPrecoCliente();
        $this->margem = $dados->getMargem();

        $this->push();
        modalSucesso('Cadastro do Kit realizado com sucesso.');
    }

    public function atualizarPrecosPeloSKU(string $sku, float $precoCliente, float $precoFornecedor)
    {
        $this->where('sku', $sku)
            ->update([
                'preco_cliente' => $precoCliente,
                'preco_fornecedor' => $precoFornecedor,
                'status_fornecedor' => 1
            ]);
    }

    public function cadastrar(FormCadastroKitRequest $request)
    {
        $this->modelo = $request->modelo;
        $this->marca_inversor = $request->marca_inversor;
        $this->potencia_inversor = $request->potencia_inversor;
        $this->marca_painel = $request->marca_painel;
        $this->potencia_painel = $request->potencia_painel;
        $this->potencia_kit = $request->potencia_kit;
        $this->fornecedor = $request->fornecedor;
        $this->preco_fornecedor = convert_money_float($request->preco_fornecedor);
        $this->estrutura = $request->estrutura;
        $this->tensao = $request->tensao;
        $this->produtos = $request->produtos;
        $this->observacoes = $request->observacoes;

        $this->push();
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
