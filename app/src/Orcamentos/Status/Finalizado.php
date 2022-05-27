<?php

namespace App\src\Orcamentos\Status;

class Finalizado implements Status
{
    private $stats = 'finalizado';

    public function getStatus(): string
    {
        return $this->stats;
    }

    public function getNome(): string
    {
        return 'Finalizado';
    }
}
