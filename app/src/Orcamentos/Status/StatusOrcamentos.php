<?php

namespace App\src\Orcamentos\Status;

class StatusOrcamentos
{
    public function todosStatus(): array
    {
        return [
            (new Novo())->getStatus() => (new Novo())->getNome(),
            (new Assinado())->getStatus() => (new Assinado())->getNome(),
            (new Aprovado())->getStatus() => (new Aprovado())->getNome(),
            (new Instalando())->getStatus() => (new Instalando())->getNome(),
            (new Finalizado())->getStatus() => (new Finalizado())->getNome(),
        ];
    }
}
