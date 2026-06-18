<?php

namespace Tests\Unit\Orcamentos\Financeiro;

use App\src\Orcamentos\Financeiro\DadosFluxoCaixa;
use App\src\Orcamentos\Financeiro\FluxoCaixaSolar;
use Tests\TestCase;

class FluxoCaixaSolarTest extends TestCase
{
    private function dados(array $overrides = []): DadosFluxoCaixa
    {
        $base = [
            'geracaoAnual' => 6000.0,
            'precoCliente' => 15000.0,
            'tarifa' => 1.0,
            'anoReferencia' => 2026,
            'dataSolicitacaoAcesso' => null,
            'degradacaoAno1' => 0.0,
            'degradacaoAnual' => 0.0,
            'inflacaoEnergetica' => 0.0,
            'percentualFioBDaTarifa' => 0.0,
            'anosProjecao' => 5,
        ];

        $dados = array_merge($base, $overrides);

        return new DadosFluxoCaixa(...$dados);
    }

    public function test_sem_fio_b_degradacao_ou_inflacao_economia_e_constante()
    {
        $fluxo = (new FluxoCaixaSolar($this->dados()))->calcular();

        $this->assertEqualsWithDelta(6000.0, $fluxo[0]['economia_liquida'], 0.01);
        $this->assertEqualsWithDelta(-9000.0, $fluxo[0]['acumulado'], 0.01);
        $this->assertSame('red', $fluxo[0]['cor']);

        $this->assertEqualsWithDelta(3000.0, $fluxo[2]['acumulado'], 0.01);
        $this->assertSame('green', $fluxo[2]['cor']);
    }

    public function test_payback_interpolado_dentro_do_ano()
    {
        $anoPayback = (new FluxoCaixaSolar($this->dados()))->anoPayback();

        // 15000 / 6000 = 2.5 anos exatos
        $this->assertEqualsWithDelta(2.5, $anoPayback, 0.01);
    }

    public function test_fio_b_reduz_a_economia_liquida_conforme_cronograma_do_ano()
    {
        $fluxo = (new FluxoCaixaSolar($this->dados(['percentualFioBDaTarifa' => 25.0])))->calcular();

        // ano1 = calendário 2026 -> Fio B 60%; custo = 6000 * 0.25 * 0.60 = 900
        $this->assertEqualsWithDelta(5100.0, $fluxo[0]['economia_liquida'], 0.01);

        // ano2 = calendário 2027 -> Fio B 75%; custo = 6000 * 0.25 * 0.75 = 1125
        $this->assertEqualsWithDelta(4875.0, $fluxo[1]['economia_liquida'], 0.01);
    }

    public function test_sem_geracao_nunca_atinge_payback()
    {
        $anoPayback = (new FluxoCaixaSolar($this->dados(['geracaoAnual' => 0.0])))->anoPayback();

        $this->assertNull($anoPayback);
    }
}
