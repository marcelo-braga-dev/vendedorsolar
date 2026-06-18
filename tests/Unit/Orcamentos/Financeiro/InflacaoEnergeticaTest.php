<?php

namespace Tests\Unit\Orcamentos\Financeiro;

use App\src\Orcamentos\Financeiro\InflacaoEnergetica;
use Tests\TestCase;

class InflacaoEnergeticaTest extends TestCase
{
    public function test_ano_1_nao_aplica_reajuste()
    {
        $this->assertEqualsWithDelta(1.0, InflacaoEnergetica::fatorAcumulado(1, 8.0), 0.0001);
    }

    public function test_ano_2_aplica_um_reajuste()
    {
        $this->assertEqualsWithDelta(1.08, InflacaoEnergetica::fatorAcumulado(2, 8.0), 0.0001);
    }

    public function test_reajustes_compoem_ano_a_ano()
    {
        // 1.08^2 = 1.1664
        $this->assertEqualsWithDelta(1.1664, InflacaoEnergetica::fatorAcumulado(3, 8.0), 0.0001);
    }
}
