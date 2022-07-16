<?php

namespace App\src\Orcamentos\Status;

class StatusOrcamentos
{
    public function todosStatus(): array
    {
        $novo = (new Novo());
        $assinado = (new Assinado());
        $aprovado = (new Aprovado());
        $reprovadoAprovacao = (new ReprovadoAprovacao());
        $instalado = (new Instalando());
        $finalizado = (new Finalizado());

        return [
            $novo->getStatus() => $novo->getNome(),
            $assinado->getStatus() => $assinado->getNome(),
            $aprovado->getStatus() => $aprovado->getNome(),
            $reprovadoAprovacao->getStatus() => $reprovadoAprovacao->getNome(),
            $instalado->getStatus() => $instalado->getNome(),
            $finalizado->getStatus() => $finalizado->getNome(),
        ];
    }
}
