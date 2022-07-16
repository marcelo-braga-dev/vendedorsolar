<?php

namespace App\src\Orcamentos\Status;

class ReprovadoAprovacao implements Status
{
    private $stats = 'reprovado_aprovacao';

    public function getStatus(): string
    {
        return $this->stats;
    }

    public function getNome(): string
    {
        return 'Aprovação Reprovada';
    }
}
