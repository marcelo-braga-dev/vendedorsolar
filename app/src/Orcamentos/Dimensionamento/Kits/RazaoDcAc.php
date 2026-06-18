<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

/**
 * Razão DC/AC (potência nominal do arranjo de painéis / potência nominal do
 * inversor). Faixa de mercado considerada normal: 1.0–1.3. Fora dessa faixa
 * não é necessariamente um erro (oversizing maior é aceitável em projetos
 * com sombreamento parcial conhecido, por exemplo), mas merece atenção do
 * vendedor antes de fechar a proposta — por isso é só um alerta, não um
 * filtro que remove o kit da lista de sugestões.
 */
class RazaoDcAc
{
    private const MINIMO_RECOMENDADO = 1.0;
    private const MAXIMO_RECOMENDADO = 1.3;

    public static function calcular(float $potenciaKitKwp, float $potenciaInversorW): ?float
    {
        if ($potenciaInversorW <= 0) {
            return null;
        }

        return round(($potenciaKitKwp * 1000) / $potenciaInversorW, 2);
    }

    public static function foraDaFaixaRecomendada(?float $razao): bool
    {
        if ($razao === null) {
            return false;
        }

        return $razao < self::MINIMO_RECOMENDADO || $razao > self::MAXIMO_RECOMENDADO;
    }
}
