<?php

namespace App\src\VisitasTecnicas\Status;

class VisitasTecnicasStatus
{
    public function todosStatus()
    {
        $nova = (new VisitaTecnicaNovaStatus());
        $finalizado = (new VisitaTecnicaFinalizadoStatus());

        return [
            $nova->getStatus() => $nova->getNome(),
            $finalizado->getStatus() => $finalizado->getNome()
        ];
    }
}
