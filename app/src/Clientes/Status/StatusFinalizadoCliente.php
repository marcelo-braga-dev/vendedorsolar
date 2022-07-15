<?php

namespace App\src\Clientes\Status;

class StatusFinalizadoCliente extends StatusClientesClasse
{

    function getStatus(): string
    {
        return 'cliente_finalizado';
    }

    function getNome(): string
    {
        return 'Atendimento Finalizado';
    }

    function atualizarStatus($id)
    {
        return;
    }
}
