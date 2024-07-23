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
    private $qtdKits;
    private $incluirTrafo;
    private $tipoConsumo;
    private $potenciaKWP;
    private $estado;

    public function __construct(DadosDimensionamento $dados)
    {
        $this->potenciaKWP = $dados->getPotenciakWP();
        $this->consumo = $dados->getConsumo();
        $this->irradiacao = $dados->getIrradiacao();
        $this->correcao = $dados->getCorrecaoCalculo();
        $this->tensao = $dados->getTensao();
        $this->estrutura = $dados->getEstrutura();
        $this->qtdKits = $dados->getQtdKits();
        $this->incluirTrafo = $dados->getIncluirTrafo();
        $this->tipoConsumo = $dados->getTipoConsumo();
        $this->estado = $dados->getEstado();
    }

    public function calcularGeracao(float $potenciaKit): float
    {
        return $this->irradiacao * 30 / (1 + $this->correcao / 100) * $potenciaKit;
    }

    public function selecionarKits(): array
    {
        $this->calcularPotencia();

        $clsKits = new SelecionarKits($this);

        return $clsKits->getKits();
    }

    protected function calcularPotencia(): void
    {
        if ($this->potenciaKWP) $this->potencia = $this->potenciaKWP;
        else {
            $resultado =
                ($this->consumo / 30) / ($this->irradiacao * (1 - 0.15));
            $resultado = $resultado * (1 + $this->correcao / 100);
            $this->potencia = round($resultado, 3);
        }
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
        return $this->qtdKits;
    }

    public function getIncluirTrafo(): bool
    {
        if ($this->incluirTrafo == 'true') return true;
        return false;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }
}
