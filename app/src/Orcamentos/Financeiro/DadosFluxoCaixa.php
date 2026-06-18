<?php

namespace App\src\Orcamentos\Financeiro;

use DateTimeInterface;

class DadosFluxoCaixa
{
    public function __construct(
        public readonly float $geracaoAnual,
        public readonly float $precoCliente,
        public readonly float $tarifa,
        public readonly int $anoReferencia,
        public readonly ?DateTimeInterface $dataSolicitacaoAcesso,
        public readonly float $degradacaoAno1,
        public readonly float $degradacaoAnual,
        public readonly float $inflacaoEnergetica,
        public readonly float $percentualFioBDaTarifa,
        public readonly int $anosProjecao = 25,
    ) {
    }
}
