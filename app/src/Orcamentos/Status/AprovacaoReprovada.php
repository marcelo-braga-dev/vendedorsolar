<?php

namespace App\src\Orcamentos\Status;

use App\Models\Orcamentos;

class AprovacaoReprovada implements Status
{
    private $stats = 'aprovacao_reprovada';

    public function getStatus(): string
    {
        return $this->stats;
    }

    public function getNome(): string
    {
        return 'Aprovação Reprovada';
    }

    public function alterarStatus($id)
    {
        (new Orcamentos())->alterarStatus($id, $this);
    }
}
