<?php

namespace App\src\VisitasTecnicas\Status;

class VisitaTecnicaNovaStatus extends VisitaTecnicaStatusClass
{

    function getStatus(): string
    {
        return 'visita_nova';
    }

    function getNome(): string
    {
        return 'Agendado';
    }

    function atualizarStatus($id)
    {
        return;
    }
}
