<?php

namespace App\src\Orcamentos\Status;

use App\Models\Orcamentos;
use App\Models\OrcamentosHistoricos;

class Aprovado implements Status
{
    private $status = 'aprovado';

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getNome(): string
    {
        return 'Aprovado';
    }

    public function alterarStatus($id)
    {
        $this->condicoesAlteracaoStatus($id);
        (new Orcamentos())->alterarStatus($id, $this);
    }

    private function condicoesAlteracaoStatus($id)
    {
        $status = (new Assinado())->getStatus();
        if ((new OrcamentosHistoricos())->statusExist($id, $status))
        throw new \DomainException('Esse orçamento precisa ser assinado.');
    }
}
