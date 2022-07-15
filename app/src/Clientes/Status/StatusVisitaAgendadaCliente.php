<?php

namespace App\src\Clientes\Status;

class StatusVisitaAgendadaCliente extends StatusClientesClasse
{

    function getStatus(): string
    {
        return 'visita_agendada';
    }

    function getNome(): string
    {
        return 'Visita agendada';
    }

    function atualizarStatus($id)
    {
        return;
    }
}
