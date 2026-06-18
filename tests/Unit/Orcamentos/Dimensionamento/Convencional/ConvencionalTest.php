<?php

namespace Tests\Unit\Orcamentos\Dimensionamento\Convencional;

use App\src\Orcamentos\Dimensionamento\Convencional\Convencional;
use App\src\Orcamentos\Dimensionamento\DadosDimensionamento;
use ReflectionClass;
use Tests\TestCase;

/**
 * Testa a fórmula de cálculo isoladamente, sem tocar o banco — os dados de
 * entrada vêm de um DTO fake, não de ConvencionalDados (que faz lookups EAV).
 */
class FakeConvencionalDados implements DadosDimensionamento
{
    public function __construct(
        private ?float $consumo = null,
        private float $irradiacao = 5.0,
        private int $correcao = 0,
        private float $perdaOrientacao = 0.0,
        private ?float $potenciakWP = null,
        private float $performanceRatio = 0.85,
    ) {
    }

    public function getPotenciakWP() { return $this->potenciakWP; }
    public function getConsumo(): ?float { return $this->consumo; }
    public function getIrradiacao(): float { return $this->irradiacao; }
    public function getCorrecaoCalculo(): int { return $this->correcao; }
    public function getTensao() { return 220; }
    public function getEstrutura() { return 1; }
    public function getQtdKits() { return 1; }
    public function getIncluirTrafo() { return false; }
    public function getTipoConsumo() { return null; }
    public function getEstado(): string { return 'PR'; }
    public function getPerdaOrientacao(): float { return $this->perdaOrientacao; }
    public function getPerformanceRatio(): float { return $this->performanceRatio; }
}

class ConvencionalTest extends TestCase
{
    private function calcularPotencia(Convencional $conv): float
    {
        $reflection = new ReflectionClass($conv);
        $method = $reflection->getMethod('calcularPotencia');
        $method->setAccessible(true);
        $method->invoke($conv);

        return $conv->getPotencia();
    }

    public function test_potencia_manual_sobrepoe_calculo_por_consumo()
    {
        $conv = new Convencional(new FakeConvencionalDados(consumo: 1000, potenciakWP: 7.5));

        $this->assertSame(7.5, $this->calcularPotencia($conv));
    }

    public function test_calculo_por_consumo_sem_perda_de_orientacao()
    {
        // (1000/30) / (5 * 0.85) = 7.843...
        $conv = new Convencional(new FakeConvencionalDados(consumo: 1000, irradiacao: 5.0, correcao: 0, perdaOrientacao: 0.0));

        $this->assertEqualsWithDelta(7.843, $this->calcularPotencia($conv), 0.001);
    }

    public function test_perda_por_orientacao_aumenta_a_potencia_calculada()
    {
        $semPerda = new Convencional(new FakeConvencionalDados(consumo: 1000, irradiacao: 5.0, correcao: 0, perdaOrientacao: 0.0));
        $comPerda = new Convencional(new FakeConvencionalDados(consumo: 1000, irradiacao: 5.0, correcao: 0, perdaOrientacao: 10.0));

        $potenciaSemPerda = $this->calcularPotencia($semPerda);
        $potenciaComPerda = $this->calcularPotencia($comPerda);

        $this->assertGreaterThan($potenciaSemPerda, $potenciaComPerda);
        // (1000/30) / (5 * 0.85 * 0.90) = 8.715...
        $this->assertEqualsWithDelta(8.715, $potenciaComPerda, 0.001);
    }

    public function test_margem_perda_administrativa_aumenta_a_potencia_calculada()
    {
        $conv = new Convencional(new FakeConvencionalDados(consumo: 1000, irradiacao: 5.0, correcao: 10, perdaOrientacao: 0.0));

        // 7.843 * 1.10 = 8.627...
        $this->assertEqualsWithDelta(8.627, $this->calcularPotencia($conv), 0.001);
    }

    public function test_geracao_reduzida_pela_perda_de_orientacao()
    {
        $semPerda = new Convencional(new FakeConvencionalDados(correcao: 0, perdaOrientacao: 0.0));
        $comPerda = new Convencional(new FakeConvencionalDados(correcao: 0, perdaOrientacao: 20.0));

        $geracaoSemPerda = $semPerda->calcularGeracao(5.0);
        $geracaoComPerda = $comPerda->calcularGeracao(5.0);

        $this->assertEqualsWithDelta($geracaoSemPerda * 0.8, $geracaoComPerda, 0.001);
    }

    public function test_performance_ratio_menor_aumenta_a_potencia_calculada()
    {
        $prAlto = new Convencional(new FakeConvencionalDados(consumo: 1000, irradiacao: 5.0, correcao: 0, performanceRatio: 0.85));
        $prBaixo = new Convencional(new FakeConvencionalDados(consumo: 1000, irradiacao: 5.0, correcao: 0, performanceRatio: 0.75));

        $this->assertGreaterThan($this->calcularPotencia($prAlto), $this->calcularPotencia($prBaixo));
    }
}
