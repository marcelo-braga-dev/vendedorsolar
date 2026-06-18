<?php

namespace Tests\Unit\Orcamentos\Financeiro;

use App\src\Orcamentos\Financeiro\FioB;
use Carbon\Carbon;
use Tests\TestCase;

class FioBTest extends TestCase
{
    public function test_segue_o_cronograma_legal_2023_a_2029()
    {
        $this->assertSame(15.0, FioB::percentualParaAno(2023));
        $this->assertSame(30.0, FioB::percentualParaAno(2024));
        $this->assertSame(45.0, FioB::percentualParaAno(2025));
        $this->assertSame(60.0, FioB::percentualParaAno(2026));
        $this->assertSame(75.0, FioB::percentualParaAno(2027));
        $this->assertSame(90.0, FioB::percentualParaAno(2028));
        $this->assertSame(100.0, FioB::percentualParaAno(2029));
    }

    public function test_anos_apos_2029_permanecem_em_100_por_cento()
    {
        $this->assertSame(100.0, FioB::percentualParaAno(2035));
    }

    public function test_anos_antes_de_2023_nao_tem_cobranca()
    {
        $this->assertSame(0.0, FioB::percentualParaAno(2022));
    }

    public function test_direito_adquirido_antes_do_marco_legal_isenta_para_sempre()
    {
        $homologacaoAntiga = Carbon::create(2022, 6, 1);

        $this->assertSame(0.0, FioB::percentualParaAno(2026, $homologacaoAntiga));
        $this->assertSame(0.0, FioB::percentualParaAno(2029, $homologacaoAntiga));
    }

    public function test_homologacao_apos_o_marco_legal_segue_cronograma_normal()
    {
        $homologacaoNova = Carbon::create(2023, 6, 1);

        $this->assertSame(60.0, FioB::percentualParaAno(2026, $homologacaoNova));
    }
}
