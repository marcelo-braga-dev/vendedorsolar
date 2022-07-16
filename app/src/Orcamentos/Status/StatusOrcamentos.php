<?php

namespace App\src\Orcamentos\Status;

class StatusOrcamentos
{
    private Novo $novo;
    private Assinado $assinado;
    private Aprovado $aprovado;
    protected AprovacaoReprovada $reprovadoAprovacao;
    private Finalizado $finalizado;
    private Instalando $instalado;

    public function __construct()
    {
        $this->novo = (new Novo());
        $this->assinado = (new Assinado());
        $this->aprovado = (new Aprovado());
        $this->reprovadoAprovacao = (new AprovacaoReprovada());
        $this->instalado = (new Instalando());
        $this->finalizado = (new Finalizado());
    }

    public function todosStatus(): array
    {
        return [
            $this->novo->getStatus() => $this->novo->getNome(),
            $this->assinado->getStatus() => $this->assinado->getNome(),
            $this->aprovado->getStatus() => $this->aprovado->getNome(),
            $this->reprovadoAprovacao->getStatus() => $this->reprovadoAprovacao->getNome(),
            $this->instalado->getStatus() => $this->instalado->getNome(),
            $this->finalizado->getStatus() => $this->finalizado->getNome(),
        ];
    }

    public function getClassStatus()
    {
        return [
            $this->novo->getStatus() => $this->novo,
            $this->assinado->getStatus() => $this->assinado,
            $this->aprovado->getStatus() => $this->aprovado,
            $this->reprovadoAprovacao->getStatus() => $this->reprovadoAprovacao,
            $this->instalado->getStatus() => $this->instalado,
            $this->finalizado->getStatus() => $this->finalizado,
        ];
    }
}
