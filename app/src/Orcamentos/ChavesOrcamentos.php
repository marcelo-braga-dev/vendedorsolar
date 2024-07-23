<?php

namespace App\src\Orcamentos;

class ChavesOrcamentos
{
    private string $consumo = 'consumo';
    private string $consumoPonta = 'consumo_ponta';
    private string $consumoForaPonta = 'consumo_fora_ponta';
    private string $demanda = 'demanda';
    private string $permitirEdicao = 'permitir_edicao';
    private string $estrutura = 'estrutura';
    private string $tensao = 'tensao';
    private string $orientacao = 'orientacao';

    public function getEstrutura(): string
    {
        return $this->estrutura;
    }

    public function getTensao(): string
    {
        return $this->tensao;
    }

    public function getOrientacao(): string
    {
        return $this->orientacao;
    }

    public function getConsumo(): string
    {
        return $this->consumo;
    }

    public function getConsumoPonta(): string
    {
        return $this->consumoPonta;
    }

    public function getConsumoForaPonta(): string
    {
        return $this->consumoForaPonta;
    }

    public function getDemanda(): string
    {
        return $this->demanda;
    }

    public function getPermitirEdicao(): string
    {
        return $this->permitirEdicao;
    }
}
