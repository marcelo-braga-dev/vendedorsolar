<?php

namespace App\src\Clientes\Status;

class StatusNovoCliente extends StatusClientesClasse
{
    function getStatus(): string
    {
        return 'novo';
    }

    function getNome(): string
    {
        return 'Novo';
    }

    function atualizarStatus($id)
    {
        return;
    }
}
