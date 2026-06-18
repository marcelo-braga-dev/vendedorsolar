<?php

namespace App\src\Orcamentos\Status;

use App\Models\Orcamentos;
use App\Models\OrcamentosHistoricos;

class Assinado implements Status
{
    private string $status;

    public function __construct()
    {
        $this->status = 'aprovando';
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getNome(): string
    {
        return 'Para Aprovação';
    }

    public function alterarStatus($id)
    {
        (new Orcamentos())->alterarStatus($id, $this);
        (new OrcamentosHistoricos())->criar($id, $this->status);
    }
}
