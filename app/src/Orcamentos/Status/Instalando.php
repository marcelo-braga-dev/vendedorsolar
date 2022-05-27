<?php

namespace App\src\Orcamentos\Status;

class Instalando implements Status
{
    private $stats = 'instalando';

    public function getStatus(): string
    {
        return $this->stats;
    }

    public function getNome(): string
    {
        return 'Em Instalação';
    }
}
