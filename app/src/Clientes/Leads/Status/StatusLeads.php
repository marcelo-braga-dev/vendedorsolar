<?php

namespace App\src\Clientes\Leads\Status;

class StatusLeads
{
    public function todosStatus()
    {
        $novo = new LeadNovo();
        $finalizado = new LeadFinalizado();

        return [
            $novo->getStatus() => $novo->getNome(),
            $finalizado->getStatus() => $finalizado->getNome(),
        ];
    }
}
