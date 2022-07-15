<?php

namespace App\src\Clientes\Leads\Status;

class LeadFinalizado
{
    public function getStatus()
    {
        return 'finalizado';
    }

    public function getNome()
    {
        return 'Finalizado';
    }
}
