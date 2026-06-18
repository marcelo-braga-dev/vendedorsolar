<?php

namespace Tests\Unit\Orcamentos\Financeiro;

use App\src\Orcamentos\Financeiro\DegradacaoPainel;
use Tests\TestCase;

class DegradacaoPainelTest extends TestCase
{
    public function test_ano_1_aplica_apenas_a_degradacao_lid()
    {
        $fator = DegradacaoPainel::fatorAcumulado(1, 2.0, 0.55);

        $this->assertEqualsWithDelta(0.98, $fator, 0.0001);
    }

    public function test_ano_2_aplica_lid_mais_um_ano_de_degradacao_anual()
    {
        $fator = DegradacaoPainel::fatorAcumulado(2, 2.0, 0.55);

        // 0.98 * (1 - 0.0055) = 0.97461
        $this->assertEqualsWithDelta(0.97461, $fator, 0.0001);
    }

    public function test_ano_0_nao_aplica_nenhuma_degradacao()
    {
        $this->assertEqualsWithDelta(1.0, DegradacaoPainel::fatorAcumulado(0, 2.0, 0.55), 0.0001);
    }
}
