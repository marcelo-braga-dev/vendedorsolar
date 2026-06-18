<?php

namespace App\src\Orcamentos\Financeiro;

/**
 * Fluxo de caixa real do investimento, ano a ano, substituindo o antigo
 * gráfico de payback com coeficientes hardcoded sem relação com tarifa,
 * geração ou Fio B reais.
 *
 * Simplificações assumidas (documentadas para transparência com o
 * cliente — ver nota no PDF):
 * - 100% da geração é considerada injetada/compensada via Sistema de
 *   Compensação de Energia Elétrica (não modela autoconsumo instantâneo
 *   por curva de carga horária).
 * - O Fio B é estimado como um percentual configurável da tarifa cheia
 *   (não decompõe TE/TUSD por concessionária).
 */
class FluxoCaixaSolar
{
    public function __construct(private DadosFluxoCaixa $dados)
    {
    }

    public function calcular(): array
    {
        $fluxo = [];
        $acumulado = -$this->dados->precoCliente;

        for ($ano = 1; $ano <= $this->dados->anosProjecao; $ano++) {
            $geracaoAno = $this->dados->geracaoAnual * DegradacaoPainel::fatorAcumulado(
                $ano,
                $this->dados->degradacaoAno1,
                $this->dados->degradacaoAnual
            );

            $tarifaAno = $this->dados->tarifa * InflacaoEnergetica::fatorAcumulado(
                $ano,
                $this->dados->inflacaoEnergetica
            );

            $economiaBruta = $geracaoAno * $tarifaAno;

            $anoCalendario = $this->dados->anoReferencia + $ano - 1;
            $percentualFioB = FioB::percentualParaAno($anoCalendario, $this->dados->dataSolicitacaoAcesso);
            $custoFioB = $economiaBruta * ($this->dados->percentualFioBDaTarifa / 100) * ($percentualFioB / 100);

            $economiaLiquida = $economiaBruta - $custoFioB;
            $acumulado += $economiaLiquida;

            $fluxo[] = [
                'ano' => $ano,
                'economia_liquida' => round($economiaLiquida, 2),
                'acumulado' => round($acumulado, 2),
                'cor' => $acumulado < 0 ? 'red' : 'green',
            ];
        }

        return $fluxo;
    }

    /**
     * Ano estimado de payback (com fração), interpolado dentro do ano em que
     * o saldo acumulado cruza zero. Retorna null se não atingir o payback
     * dentro do horizonte de projeção.
     */
    public function anoPayback(): ?float
    {
        $saldoAnterior = -$this->dados->precoCliente;

        foreach ($this->calcular() as $linha) {
            if ($linha['acumulado'] >= 0) {
                $economiaDoAno = $linha['acumulado'] - $saldoAnterior;

                $fracao = $economiaDoAno > 0 ? (-$saldoAnterior) / $economiaDoAno : 0;

                return ($linha['ano'] - 1) + $fracao;
            }

            $saldoAnterior = $linha['acumulado'];
        }

        return null;
    }
}
