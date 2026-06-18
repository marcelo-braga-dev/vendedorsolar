<?php

namespace App\src\Orcamentos\Financeiro;

/**
 * Fator de geração restante de um painel em um determinado ano de operação,
 * considerando a degradação induzida pela luz (LID) no 1º ano e a
 * degradação linear anual a partir do 2º ano (conforme curva de garantia
 * típica de fabricante).
 */
class DegradacaoPainel
{
    public static function fatorAcumulado(int $ano, float $degradacaoAno1, float $degradacaoAnual): float
    {
        if ($ano <= 0) {
            return 1.0;
        }

        $fator = 1 - $degradacaoAno1 / 100;

        if ($ano > 1) {
            $fator *= (1 - $degradacaoAnual / 100) ** ($ano - 1);
        }

        return $fator;
    }
}
