<?php

namespace App\src\VisitasTecnicas\Status;

abstract class VisitaTecnicaStatusClass
{
    abstract function getStatus(): string;

    abstract function getNome(): string;

    abstract function atualizarStatus($id);
}
