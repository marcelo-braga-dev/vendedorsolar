<?php

namespace App\src\Orcamentos\Status;

use App\Models\Orcamentos;

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

    public function alterarStatus($id)
    {
        (new Orcamentos())->alterarStatus($id, $this);
    }
}
