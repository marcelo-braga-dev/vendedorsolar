<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

use App\Models\Kits;

abstract class SelecionarKitsDB
{
    protected function kits($potencia, $estrutura, $qtdKits)
    {
        $potencia /= $qtdKits;
        $variacao = $this->variacao($potencia);

        return Kits::query()
            ->where([
                ['estrutura', '=', $estrutura],
                ['potencia_kit', '>=', $variacao['min']],
                ['potencia_kit', '<=', $variacao['max']],
                ['status', '=', true],
                ['status_fornecedor', '=', true]
            ])
            ->orderBy('preco_cliente', 'ASC')
            ->get([
                'id', 'marca_inversor', 'marca_painel',
                'modelo', 'preco_cliente', 'tensao',
                'potencia_kit', 'potencia_painel',
                'potencia_inversor', 'estrutura'
            ]);
    }

    private function variacao(float $potencia): array
    {
        $variacaoPot = 500;
        if ($potencia > 1 ) $variacaoPot = 100;
        if ($potencia > 1.5 ) $variacaoPot = 30;
        if ($potencia > 3 ) $variacaoPot = 15;
        if ($potencia > 5 ) $variacaoPot = 5;

        $min = $potencia * (1 - ($variacaoPot / 100));
        $max = $potencia * (1 + ($variacaoPot / 100));

        return ['min' => $min, 'max' => $max];
    }
}
