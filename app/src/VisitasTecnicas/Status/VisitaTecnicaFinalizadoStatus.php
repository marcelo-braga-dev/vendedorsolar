<?php

namespace App\src\VisitasTecnicas\Status;

class VisitaTecnicaFinalizadoStatus extends VisitaTecnicaStatusClass
{
    function getStatus(): string
    {
        return 'visita_finalizada';
    }

    function getNome(): string
    {
        return 'Finalizado';
    }

    function atualizarStatus($id)
    {
        return;
    }
}
