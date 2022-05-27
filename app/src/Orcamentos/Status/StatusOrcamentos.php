<?php

namespace App\src\Orcamentos\Status;

class StatusOrcamentos
{
    public function todosStatus(): array
    {
        return [
            [
                'status' => (new Novo())->getStatus(),
                'nome' => (new Novo())->getNome()
            ], [
                'status' => (new Assinado())->getStatus(),
                'nome' => (new Assinado())->getNome()
            ], [
                'status' => (new Aprovado())->getStatus(),
                'nome' => (new Aprovado())->getNome()
            ], [
                'status' => (new Instalando())->getStatus(),
                'nome' => (new Instalando())->getNome()
            ], [
                'status' => (new Finalizado())->getStatus(),
                'nome' => (new Finalizado())->getNome()
            ]
        ];
    }
}
