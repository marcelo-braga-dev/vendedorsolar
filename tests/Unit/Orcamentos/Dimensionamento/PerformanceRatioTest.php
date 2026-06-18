<?php

namespace Tests\Unit\Orcamentos\Dimensionamento;

use App\src\Orcamentos\Dimensionamento\PerformanceRatio;
use Tests\TestCase;

class PerformanceRatioTest extends TestCase
{
    public function test_sem_perdas_resulta_em_pr_de_100_por_cento()
    {
        $this->assertEqualsWithDelta(1.0, PerformanceRatio::compor([0, 0, 0, 0, 0, 0]), 0.0001);
    }

    public function test_perdas_se_compoem_multiplicativamente_nao_somam()
    {
        // (1-0.10) * (1-0.10) = 0.81, não 0.80 (que seria soma simples)
        $this->assertEqualsWithDelta(0.81, PerformanceRatio::compor([10, 10]), 0.0001);
    }

    public function test_valores_padrao_de_seed_resultam_em_pr_proximo_de_085()
    {
        // Calibração padrão da migration de seed (substitui o antigo 15% fixo)
        $pr = PerformanceRatio::compor([5.5, 3.2, 1.9, 2.4, 1.6, 1.3]);

        $this->assertEqualsWithDelta(0.85, $pr, 0.001);
    }
}
