<?php

namespace App\src\Orcamentos\Dimensionamento\Convencional;

use App\src\Orcamentos\Dimensionamento\DadosDimensionamento;
use App\src\Orcamentos\Dimensionamento\Dimensionamento;
use App\src\Orcamentos\Dimensionamento\Kits\SelecionarKits;

class Convencional extends Dimensionamento
{
    private $consumo;
    private $irradiacao;
    private $correcao;
    private $potencia;
    private $tensao;
    private $estrutura;

    public function __construct(DadosDimensionamento $dados)
    {
        $this->consumo = $dados->getConsumo();
        $this->irradiacao = $dados->getIrradiacao();
        $this->correcao = $dados->getCorrecaoCalculo();
        $this->tensao = $dados->getTensao();
        $this->estrutura = $dados->getEstrutura();
    }

    public function calcularGeracao(float $potenciaKit): float
    {
        return $this->irradiacao * 30 / (1 + $this->correcao/100) * $potenciaKit;
    }

    public function selecionarKits(): array
    {
        $this->calcularPotencia();

        $clsKits = new SelecionarKits($this);

        return $clsKits->getKits();
    }

    protected function calcularPotencia(): void
    {
        $resultado =
            ($this->consumo / 30) / ($this->irradiacao * (1 - 0.15));
        $resultado = $resultado * (1 + $this->correcao / 100);

        $this->potencia = round($resultado, 3);
    }

    public function getPotencia(): float
    {
        return $this->potencia;
    }

    public function getTensao(): int
    {
        return $this->tensao;
    }

    public function getEstrutura(): int
    {
        return $this->estrutura;
    }

    public function getQtdKits(): int
    {
        return 1;
    }

    public function getIncluirTrafo(): bool
    {
        return true;
    }
}
