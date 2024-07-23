<?php

namespace App\Services\Orcamentos;

class ComissaoVendedorService
{
    public function calcular($trafo, $orcamento, $kit, $orcamentoKit)
    {
        $precoTrafo = 0;
        if (!empty($trafo)) $precoTrafo = $trafo->preco_fornecedor;
        return $orcamento->preco_cliente * ($orcamentoKit->taxa_comissao / 100);
    }
}
