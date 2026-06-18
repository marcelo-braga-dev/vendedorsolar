<?php

namespace App\src\Orcamentos\Financeiro;

use DateTimeInterface;

/**
 * Cronograma legal de cobrança do Fio B (Lei 14.300/2022, regulamentada pela
 * REN ANEEL 1.059/2023) sobre a energia injetada/compensada. O percentual
 * sobe progressivamente até 100% em 2029. Sistemas cuja solicitação de
 * acesso foi protocolada antes de 7/1/2023 têm direito adquirido e nunca
 * pagam Fio B sob essa regra de transição.
 */
class FioB
{
    private const DATA_MARCO_LEGAL = '2023-01-07';

    private const CRONOGRAMA = [
        2023 => 15.0,
        2024 => 30.0,
        2025 => 45.0,
        2026 => 60.0,
        2027 => 75.0,
        2028 => 90.0,
    ];

    public static function percentualParaAno(int $anoCalendario, ?DateTimeInterface $dataSolicitacaoAcesso = null): float
    {
        if ($dataSolicitacaoAcesso !== null && $dataSolicitacaoAcesso->format('Y-m-d') < self::DATA_MARCO_LEGAL) {
            return 0.0;
        }

        if ($anoCalendario < 2023) {
            return 0.0;
        }

        if ($anoCalendario >= 2029) {
            return 100.0;
        }

        return self::CRONOGRAMA[$anoCalendario];
    }
}
