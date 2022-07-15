<?php

namespace App\src\Clientes\Status;

use App\Models\Clientes;

class StatusEmitidoOrcamentoCliente extends StatusClientesClasse
{
    function getStatus(): string
    {
        return 'emitido_orcamento';
    }

    function getNome(): string
    {
        return 'Orçamento gerado';
    }

    function atualizarStatus($id)
    {
        $novo = (new StatusNovoCliente())->getStatus();
        $cliente = (new Clientes())->newQuery()->find($id);
        if ($cliente->status == $novo) (new Clientes())->atualizarStatus($id, $this);
    }
}
