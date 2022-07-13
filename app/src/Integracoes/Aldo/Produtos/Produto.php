<?php

namespace App\src\Integracoes\Aldo\Produtos;

use App\Models\Kits;
use App\src\Integracoes\Aldo\AcoesAoLerArquivo\Acoes;
use App\src\Integracoes\Aldo\VerificaCategoriaProduto;
use App\src\Produtos\CalculoPrecos\CalcularPrecoVenda;
use App\src\Produtos\CalculoPrecos\MargensPadrao;

class Produto implements Acoes
{
    private array $skus;

    public function __construct()
    {
        $this->skus = $this->getSkus();
    }

    private function getSkus()
    {
        $skus = [];

        $kits = new Kits();
        $skus_ = $kits->newQuery()
            ->where('fornecedor', '=', 1)
            ->get(['sku', 'preco_fornecedor']);

        foreach ($skus_ as $item) {
            $skus[$item->sku] = $item->preco_fornecedor;
        }
        return $skus;
    }

    public function executar($dados, $indices)
    {
        $verificar = new VerificaCategoriaProduto();
        $categoria = $verificar->categoria($dados, $indices);

        if ($categoria !== null) {
            if (!empty($this->skus[strip_tags($dados->codigo)])) {
                $this->atualizarKit($dados);
                return;
            }
            $categoria->cadastrarKit($this->token);
        }
    }

    private function atualizarKit($dados): void
    {
        $precoAtual = number_format($this->skus[strip_tags($dados->codigo)], 2, '.', '');;
        $precoFornecedor = convert_money_float(strip_tags($dados->preco));

        if ($precoAtual != $precoFornecedor) {
            $calcular = new CalcularPrecoVenda();
            $preco = $calcular->calcular(new MargensPadrao($precoFornecedor, strip_tags($dados->atributos->POTENCIA_W)));

            $kits = new Kits();
            $kits->atualizarPrecosPeloSKU(strip_tags($dados->codigo), $preco['preco'], $precoFornecedor);
        }
        unset($this->skus[strip_tags($dados->codigo)]);
    }
}
