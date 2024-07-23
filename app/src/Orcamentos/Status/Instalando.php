<?php

namespace App\src\Orcamentos\Status;

use App\Models\Orcamentos;

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

    public function alterarStatus($id)
    {
        (new Orcamentos())->alterarStatus($id, $this);
    }
}
