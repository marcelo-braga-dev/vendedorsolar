<?php

namespace App\src\Clientes\Status;

abstract class StatusClientesClasse
{
    abstract function getStatus(): string;

    abstract function getNome(): string;

    abstract function atualizarStatus($id);
}
