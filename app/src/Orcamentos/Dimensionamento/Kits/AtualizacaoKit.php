<?php

namespace App\src\Orcamentos\Dimensionamento\Kits;

use Carbon\Carbon;
use DateTimeInterface;

/**
 * Decide se um kit está com os valores desatualizados, com base no limite de
 * dias configurável em /admin/sistema (getKitLimiteDiasAtualizacao()).
 */
class AtualizacaoKit
{
    public static function diasDesatualizado(?DateTimeInterface $atualizadoEm): ?int
    {
        if ($atualizadoEm === null) {
            return null;
        }

        return (int) Carbon::instance($atualizadoEm)->diffInDays(Carbon::now());
    }

    public static function emAlerta(?int $diasDesatualizado, int $limiteDias): bool
    {
        return $diasDesatualizado !== null && $diasDesatualizado > $limiteDias;
    }
}
