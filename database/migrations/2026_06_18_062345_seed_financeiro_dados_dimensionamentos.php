<?php

use App\Models\DadosDimensionamento;
use Illuminate\Database\Migrations\Migration;

/**
 * Semeia as premissas financeiras padrão usadas no novo motor de payback
 * (substitui o gráfico hardcoded com coeficientes mágicos):
 * - degradacao_ano1 / degradacao_anual: curva de garantia típica de painel.
 * - inflacao_energetica: 8% a.a., escolhido como meio-termo da faixa de
 *   mercado (6-10% a.a.) — decisão confirmada com o usuário.
 * - fio_b_percentual_tarifa: 25%, estimativa nacional simplificada da
 *   parcela TUSD-Fio B sobre a tarifa cheia (sem decompor por
 *   concessionária — decisão confirmada com o usuário). Ajustável pelo
 *   admin em /admin/configs/dimensionamento.
 */
class SeedFinanceiroDadosDimensionamentos extends Migration
{
    public function up()
    {
        $dados = new DadosDimensionamento();

        $dados->setDegradacaoAno1(2.0);
        $dados->setDegradacaoAnual(0.55);
        $dados->setInflacaoEnergetica(8.0);
        $dados->setFioBPercentualTarifa(25.0);
    }

    public function down()
    {
        DadosDimensionamento::query()
            ->where('meta', '=', (new DadosDimensionamento())->financeiro)
            ->delete();
    }
}
