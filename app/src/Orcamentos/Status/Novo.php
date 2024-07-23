<?php

namespace App\src\Orcamentos\Status;

class Novo implements Status
{
    private $stats = 'novo';

    public function getStatus(): string
    {
        return $this->stats;
    }

    public function getNome(): string
    {
        return 'Novo';
    }

    public function alterarStatus($id)
    {
        // TODO: Implement alterarStatus() method.
    }
}
