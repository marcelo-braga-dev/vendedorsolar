<?php

namespace Tests\Unit\Orcamentos\Dimensionamento\Demanda;

use App\src\Orcamentos\Dimensionamento\DadosDimensionamento;
use App\src\Orcamentos\Dimensionamento\Demanda\Demanda;
use ReflectionClass;
use Tests\TestCase;

/**
 * Testa a fórmula de cálculo isoladamente, sem tocar o banco — os dados de
 * entrada vêm de um DTO fake, não de DemandaDados (que faz lookups EAV/DB).
 */
class FakeDemandaDados implements DadosDimensionamento
{
    public function __construct(
        private float $consumoForaPonta = 0,
        private float $consumoPonta = 0,
        private float $irradiacao = 5.0,
        private int $correcao = 0,
        private float $perdaOrientacao = 0.0,
        private float $tarifaPonta = 0.99967,
        private float $tarifaForaPonta = 0.47392,
        private float $performanceRatio = 0.85,
    ) {
    }

    public function getConsumoForaPonta(): float { return $this->consumoForaPonta; }
    public function getConsumoPonta() { return $this->consumoPonta; }
    public function getIrradiacao(): float { return $this->irradiacao; }
    public function getCorrecaoCalculo(): int { return $this->correcao; }
    public function getTensao() { return 220; }
    public function getEstrutura() { return 1; }
    public function getQtdKits() { return 1; }
    public function getTarifas() { return (object) ['ponta' => $this->tarifaPonta, 'fora_ponta' => $this->tarifaForaPonta]; }
    public function getIncluirTrafo() { return false; }
    public function getEstado(): string { return 'PR'; }
    public function getPerdaOrientacao(): float { return $this->perdaOrientacao; }
    public function getPerformanceRatio(): float { return $this->performanceRatio; }
}

class DemandaTest extends TestCase
{
    private function calcularPotencia(Demanda $demanda): float
    {
        $reflection = new ReflectionClass($demanda);
        $method = $reflection->getMethod('calcularPotencia');
        $method->setAccessible(true);
        $method->invoke($demanda);

        return $demanda->getPotencia();
    }

    public function test_consumo_ponderado_pelo_fator_de_carga()
    {
        $demanda = new Demanda(new FakeDemandaDados(
            consumoForaPonta: 1000,
            consumoPonta: 200,
            irradiacao: 5.0,
            correcao: 0,
            tarifaPonta: 1.0,
            tarifaForaPonta: 0.5,
        ));

        // fc = 1.0/0.5 = 2; mediaConsumo = 1000 + (2*200) = 1400
        // (1400/30) / (5*0.85) = 10.980...
        $this->assertEqualsWithDelta(10.980, $this->calcularPotencia($demanda), 0.001);
    }

    public function test_perda_por_orientacao_aumenta_a_potencia_calculada()
    {
        $semPerda = new Demanda(new FakeDemandaDados(consumoForaPonta: 1000, consumoPonta: 200, perdaOrientacao: 0.0));
        $comPerda = new Demanda(new FakeDemandaDados(consumoForaPonta: 1000, consumoPonta: 200, perdaOrientacao: 15.0));

        $this->assertGreaterThan(
            $this->calcularPotencia($semPerda),
            $this->calcularPotencia($comPerda)
        );
    }

    public function test_geracao_reduzida_pela_perda_de_orientacao()
    {
        $semPerda = new Demanda(new FakeDemandaDados(correcao: 0, perdaOrientacao: 0.0));
        $comPerda = new Demanda(new FakeDemandaDados(correcao: 0, perdaOrientacao: 25.0));

        $this->assertEqualsWithDelta(
            $semPerda->calcularGeracao(5.0) * 0.75,
            $comPerda->calcularGeracao(5.0),
            0.001
        );
    }
}
