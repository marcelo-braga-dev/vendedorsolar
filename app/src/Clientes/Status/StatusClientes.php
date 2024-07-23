<?php

namespace App\src\Clientes\Status;

class StatusClientes
{
    public function todosStatus(): array
    {
        $novo = (new StatusNovoCliente());
        $emitido = (new StatusEmitidoOrcamentoCliente());
        $visitaAgendada = (new StatusVisitaAgendadaCliente());

        return [
            $novo->getStatus() => $novo->getNome(),
            $emitido->getStatus() => $emitido->getNome(),
            $visitaAgendada->getStatus() => $visitaAgendada->getNome(),
        ];
    }
}
