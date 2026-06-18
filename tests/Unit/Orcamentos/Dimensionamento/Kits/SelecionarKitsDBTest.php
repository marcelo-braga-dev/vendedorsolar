<?php

namespace Tests\Unit\Orcamentos\Dimensionamento\Kits;

use App\src\Orcamentos\Dimensionamento\Dimensionamento;
use App\src\Orcamentos\Dimensionamento\Kits\SelecionarKits;
use App\src\Orcamentos\Dimensionamento\Kits\SelecionarKitsDB;
use ReflectionClass;
use Tests\TestCase;

class FakeDimensionamento extends Dimensionamento
{
    public function calcularGeracao(float $potenciaKit): float { return 0; }
    public function selecionarKits(): array { return []; }
    public function getPotencia(): float { return 5.0; }
    public function getTensao(): int { return 220; }
    public function getEstrutura(): int { return 1; }
    protected function calcularPotencia(): void {}
    public function getQtdKits(): int { return 1; }
    public function getIncluirTrafo() { return false; }
    public function getEstado(): string { return 'PR'; }
}

/**
 * Testa só a faixa de tolerância de potência usada na seleção de kit
 * (banda que se estreita conforme a potência cresce) — pura aritmética,
 * sem consulta ao banco.
 */
class SelecionarKitsDBTest extends TestCase
{
    private function variacao(float $potencia): array
    {
        $instancia = new SelecionarKits(new FakeDimensionamento());

        $reflection = new ReflectionClass(SelecionarKitsDB::class);
        $method = $reflection->getMethod('variacao');
        $method->setAccessible(true);

        return $method->invoke($instancia, $potencia);
    }

    public function test_faixa_de_100_por_cento_para_potencia_ate_1kwp()
    {
        $variacao = $this->variacao(0.8);

        $this->assertEqualsWithDelta(0.0, $variacao['min'], 0.0001);
        $this->assertEqualsWithDelta(1.6, $variacao['max'], 0.0001);
    }

    public function test_faixa_de_10_por_cento_acima_de_1kwp()
    {
        $variacao = $this->variacao(2.0);

        $this->assertEqualsWithDelta(1.8, $variacao['min'], 0.0001);
        $this->assertEqualsWithDelta(2.2, $variacao['max'], 0.0001);
    }

    public function test_faixa_de_5_por_cento_acima_de_10kwp()
    {
        $variacao = $this->variacao(15.0);

        $this->assertEqualsWithDelta(14.25, $variacao['min'], 0.0001);
        $this->assertEqualsWithDelta(15.75, $variacao['max'], 0.0001);
    }

    public function test_faixa_de_3_por_cento_acima_de_20kwp()
    {
        $variacao = $this->variacao(30.0);

        $this->assertEqualsWithDelta(29.1, $variacao['min'], 0.0001);
        $this->assertEqualsWithDelta(30.9, $variacao['max'], 0.0001);
    }
}
