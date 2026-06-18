<?php

namespace Tests\Unit\Orcamentos\Dimensionamento\Kits;

use App\src\Orcamentos\Dimensionamento\Kits\AtualizacaoKit;
use Carbon\Carbon;
use Tests\TestCase;

class AtualizacaoKitTest extends TestCase
{
    public function test_kit_atualizado_dentro_do_limite_nao_gera_alerta()
    {
        $dias = AtualizacaoKit::diasDesatualizado(Carbon::now()->subDays(2));

        $this->assertSame(2, $dias);
        $this->assertFalse(AtualizacaoKit::emAlerta($dias, 10));
    }

    public function test_kit_desatualizado_alem_do_limite_gera_alerta()
    {
        $dias = AtualizacaoKit::diasDesatualizado(Carbon::now()->subDays(20));

        $this->assertSame(20, $dias);
        $this->assertTrue(AtualizacaoKit::emAlerta($dias, 10));
    }

    public function test_exatamente_no_limite_nao_gera_alerta()
    {
        $dias = AtualizacaoKit::diasDesatualizado(Carbon::now()->subDays(10));

        $this->assertFalse(AtualizacaoKit::emAlerta($dias, 10));
    }

    public function test_sem_data_de_atualizacao_nao_gera_alerta()
    {
        $this->assertNull(AtualizacaoKit::diasDesatualizado(null));
        $this->assertFalse(AtualizacaoKit::emAlerta(null, 10));
    }
}
