<?php

namespace App\src\Orcamentos\Financeiro;

/**
 * Fator de reajuste tarifário composto até um determinado ano de projeção.
 * Estimativa configurável pelo admin — nunca deve ser apresentada ao
 * cliente como garantia, apenas como projeção.
 */
class InflacaoEnergetica
{
    public static function fatorAcumulado(int $ano, float $taxaAnual): float
    {
        if ($ano <= 0) {
            return 1.0;
        }

        return (1 + $taxaAnual / 100) ** ($ano - 1);
    }
}
