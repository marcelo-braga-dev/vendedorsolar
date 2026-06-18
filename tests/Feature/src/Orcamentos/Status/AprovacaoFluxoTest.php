<?php

namespace Tests\Feature\src\Orcamentos\Status;

use App\Models\Orcamentos;
use App\Models\OrcamentosHistoricos;
use App\src\Orcamentos\Status\Aprovado;
use App\src\Orcamentos\Status\Assinado;
use Tests\TestCase;

class AprovacaoFluxoTest extends TestCase
{
    public function test_assinar_grava_historico_e_libera_aprovacao()
    {
        $orcamento = Orcamentos::query()->create([
            'users_id' => 3,
            'clientes_id' => 2,
            'preco_cliente' => 1000,
            'status' => 'novo',
            'geracao' => 100,
            'cidade' => 1,
            'token' => 'teste-aprovacao-fluxo-' . uniqid(),
        ]);

        (new Assinado())->alterarStatus($orcamento->id);

        $this->assertTrue(
            OrcamentosHistoricos::query()
                ->where('orcamentos_id', $orcamento->id)
                ->where('status', 'aprovando')
                ->exists()
        );

        // Antes da correção, isso lançava DomainException mesmo já assinado.
        (new Aprovado())->alterarStatus($orcamento->id);

        $this->assertSame('aprovado', $orcamento->refresh()->status);

        OrcamentosHistoricos::query()->where('orcamentos_id', $orcamento->id)->delete();
        $orcamento->delete();
    }
}
