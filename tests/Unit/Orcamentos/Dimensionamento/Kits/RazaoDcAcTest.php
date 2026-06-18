<?php

namespace Tests\Unit\Orcamentos\Dimensionamento\Kits;

use App\src\Orcamentos\Dimensionamento\Kits\RazaoDcAc;
use Tests\TestCase;

class RazaoDcAcTest extends TestCase
{
    public function test_calcula_razao_entre_potencia_do_kit_e_do_inversor()
    {
        // 6 kWp de painéis / 5000 W de inversor = 1.2
        $this->assertEqualsWithDelta(1.2, RazaoDcAc::calcular(6.0, 5000), 0.001);
    }

    public function test_dentro_da_faixa_recomendada_nao_gera_alerta()
    {
        $this->assertFalse(RazaoDcAc::foraDaFaixaRecomendada(1.2));
        $this->assertFalse(RazaoDcAc::foraDaFaixaRecomendada(1.0));
        $this->assertFalse(RazaoDcAc::foraDaFaixaRecomendada(1.3));
    }

    public function test_fora_da_faixa_recomendada_gera_alerta()
    {
        $this->assertTrue(RazaoDcAc::foraDaFaixaRecomendada(1.45));
        $this->assertTrue(RazaoDcAc::foraDaFaixaRecomendada(0.8));
    }

    public function test_inversor_zero_nao_calcula_razao()
    {
        $this->assertNull(RazaoDcAc::calcular(6.0, 0));
        $this->assertFalse(RazaoDcAc::foraDaFaixaRecomendada(null));
    }
}
