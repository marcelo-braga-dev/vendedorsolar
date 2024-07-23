<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

use App\Models\PrecificacaoMetas;

class CalculaPrecoVenda
{
    public function calculaPrecoKits($item, $qtdKits, $estado): void
    {
        $margemEstado = $this->margemEstado($estado);
        $margemVendedor = $this->margemVendedor();
        $margemEstrutura = $this->margemEstrutura($item->estrutura);
        $margemFornecedor = $this->margemFornecedor($item->fornecedor);
        
        $item->preco_cliente =
            $item->preco_fornecedor * $qtdKits *
            (1 + (getMargemPrincipal($item->id) + $margemVendedor + $margemEstrutura + $margemEstado + $margemFornecedor) / 100);
    }

    private function margemFornecedor($id)
    {
        return (new PrecificacaoMetas())->getFornecedor($id) ?? 0;
    }

    private function margemEstado($estado)
    {
        return (new PrecificacaoMetas())->getEstado($estado) ?? 0;
    }

    private function margemVendedor()
    {
        return (new PrecificacaoMetas())->getVendedor(id_usuario_atual()) ?? 0;
    }

    private function margemEstrutura($id)
    {
        return (new PrecificacaoMetas())->getEstrutura($id) ?? 0;
    }
}
