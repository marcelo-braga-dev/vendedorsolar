<?php

namespace App\src\Orcamentos\Dimensionamento;

abstract class Dimensionamento
{
    abstract public function calcularGeracao(float $potenciaKit): float;

    abstract public function selecionarKits(): array;

    abstract public function getPotencia(): float;

    abstract public function getTensao(): int;

    abstract public function getEstrutura(): int;

    abstract protected function calcularPotencia(): void;

    abstract public function getQtdKits(): int;

    abstract public function getIncluirTrafo();

    abstract public function getEstado(): string;
}
