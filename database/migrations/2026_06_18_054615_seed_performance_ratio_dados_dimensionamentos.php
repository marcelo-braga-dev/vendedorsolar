<?php

use App\Models\DadosDimensionamento;
use Illuminate\Database\Migrations\Migration;

/**
 * Semeia os 6 fatores de Performance Ratio (PR) com valores padrão calibrados
 * para que o PR composto resultante seja ~0.85 — preservando, no dia do
 * deploy, o mesmo número que antes era um 15% fixo hardcoded no cálculo de
 * Convencional/Demanda. O admin pode recalibrar cada fator individualmente
 * depois, orientado por dados reais de geração medida.
 */
class SeedPerformanceRatioDadosDimensionamentos extends Migration
{
    public function up()
    {
        $dados = new DadosDimensionamento();

        $dados->setPerdaTemperatura(5.5);
        $dados->setPerdaSujeira(3.2);
        $dados->setPerdaCabeamento(2.4);
        $dados->setPerdaSombreamento(1.9);
        $dados->setPerdaMismatch(1.6);
        $dados->setPerdaDegradacaoInicial(1.3);
    }

    public function down()
    {
        DadosDimensionamento::query()
            ->where('meta', '=', (new DadosDimensionamento())->performanceRatio)
            ->delete();
    }
}
