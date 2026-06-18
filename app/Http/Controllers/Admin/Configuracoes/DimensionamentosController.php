<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\DadosDimensionamento;
use Illuminate\Http\Request;

class DimensionamentosController extends Controller
{
    public function index()
    {
        $dadosDimensionamento = new DadosDimensionamento();
        $dados = [
            'margem_perda' => $dadosDimensionamento->getMargemPerda(),
            'sobra_potencia' => $dadosDimensionamento->getSobraPotencia(),
            'orientacao_nordeste_noroeste' => $dadosDimensionamento->getPerdaNordesteNoroeste(),
            'orientacao_leste_oeste' => $dadosDimensionamento->getPerdaLesteOeste(),
            'orientacao_sudeste_sudoeste' => $dadosDimensionamento->getPerdaSudesteSudoeste(),
            'orientacao_sul' => $dadosDimensionamento->getPerdaSul(),
            'pr_temperatura' => $dadosDimensionamento->getPerdaTemperatura(),
            'pr_sujeira' => $dadosDimensionamento->getPerdaSujeira(),
            'pr_sombreamento' => $dadosDimensionamento->getPerdaSombreamento(),
            'pr_cabeamento' => $dadosDimensionamento->getPerdaCabeamento(),
            'pr_mismatch' => $dadosDimensionamento->getPerdaMismatch(),
            'pr_degradacao_inicial' => $dadosDimensionamento->getPerdaDegradacaoInicial(),
            'performance_ratio' => round($dadosDimensionamento->getPerformanceRatio() * 100, 2),
            'degradacao_ano1' => $dadosDimensionamento->getDegradacaoAno1(),
            'degradacao_anual' => $dadosDimensionamento->getDegradacaoAnual(),
            'inflacao_energetica' => $dadosDimensionamento->getInflacaoEnergetica(),
            'fio_b_percentual_tarifa' => $dadosDimensionamento->getFioBPercentualTarifa(),
        ];

        return view('pages.admin.configs.dimensionamento.index', compact('dados'));
    }

    public function store(Request $request)
    {
        $dadosDimensionamento = new DadosDimensionamento();

        $dadosDimensionamento->setMargemPerda($request->margem_perda);
        //$dadosDimensionamento->setSobraPotencia($request->sobra_potencia);
        $dadosDimensionamento->setPerdaNordesteNoroeste($request->orientacao_nordeste_noroeste);
        $dadosDimensionamento->setPerdaLesteOeste($request->orientacao_leste_oeste);
        $dadosDimensionamento->setPerdaSudesteSudoeste($request->orientacao_sudeste_sudoeste);
        $dadosDimensionamento->setPerdaSul($request->orientacao_sul);
        $dadosDimensionamento->setPerdaTemperatura($request->pr_temperatura);
        $dadosDimensionamento->setPerdaSujeira($request->pr_sujeira);
        $dadosDimensionamento->setPerdaSombreamento($request->pr_sombreamento);
        $dadosDimensionamento->setPerdaCabeamento($request->pr_cabeamento);
        $dadosDimensionamento->setPerdaMismatch($request->pr_mismatch);
        $dadosDimensionamento->setPerdaDegradacaoInicial($request->pr_degradacao_inicial);
        $dadosDimensionamento->setDegradacaoAno1($request->degradacao_ano1);
        $dadosDimensionamento->setDegradacaoAnual($request->degradacao_anual);
        $dadosDimensionamento->setInflacaoEnergetica($request->inflacao_energetica);
        $dadosDimensionamento->setFioBPercentualTarifa($request->fio_b_percentual_tarifa);

        modalSucesso('Dados atualizados com sucesso.');
        return redirect()->back();
    }
}
