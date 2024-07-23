<?php

namespace App\src\Integracoes\Aldo\Produtos;

use App\Models\Kits;
use App\src\Integracoes\Aldo\AcoesAoLerArquivo\Acoes;
use App\src\Integracoes\Aldo\VerificaCategoriaProduto;

class Produto implements Acoes
{
    private array $skus;

    public function __construct()
    {
        $this->skus = $this->getSkus();
    }

    private function getSkus()
    {
        $items = (new Kits())->newQuery()
            ->where('fornecedor', '=', 1)
            ->get(['sku', 'preco_fornecedor']);

        $skus = [];
        foreach ($items as $item) {
            $skus[$item->sku] = $item->preco_fornecedor;
        }
        return $skus;
    }

    public function executar($dados, $indices)
    {
        $categoria = (new VerificaCategoriaProduto())
            ->categoria($dados, $indices);

        if ($categoria !== null) {
            if (!empty($this->skus[strip_tags($dados->codigo)])) {
                $categoria->atualizarPreco($dados, $this->skus);
                unset($this->skus[strip_tags($dados->codigo)]);
                return;
            }
            $categoria->cadastrar($dados);
        }
    }
}
