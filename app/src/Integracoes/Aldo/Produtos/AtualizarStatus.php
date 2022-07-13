<?php

namespace App\src\Integracoes\Aldo\Produtos;

use App\Models\Kits;
use App\src\Integracoes\Aldo\AcoesAoLerArquivo\Acoes;

class AtualizarStatus implements Acoes
{
    private $skus = [];

    public function executar($dados, $indices)
    {
        $this->skus[] = strip_tags($dados->codigo);
    }

    public function atualizar()
    {
        $kits = (new Kits())->newQuery();
        $kits->update(['status_fornecedor' => 0]);

        foreach ($this->skus as $sku) {
            $kits->orWhere('sku', $sku);
        }
        $kits->update(['status_fornecedor' => 1]);
    }
}
