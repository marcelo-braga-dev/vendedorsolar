<?php

namespace App\src\Orcamentos\Dimensionamento;

/**
 * Compõe o Performance Ratio (PR) do sistema a partir de fatores de perda
 * percentuais (temperatura, sujeira, sombreamento, cabeamento, mismatch,
 * degradação inicial). As perdas se compõem multiplicativamente — não somam
 * — pois cada fator atua sobre o que sobrou do anterior (mesma lógica usada
 * por ferramentas de simulação como PVsyst).
 */
class PerformanceRatio
{
    public static function compor(array $perdasPercentuais): float
    {
        $pr = 1.0;

        foreach ($perdasPercentuais as $perda) {
            $pr *= (1 - ((float) $perda) / 100);
        }

        return $pr;
    }
}
