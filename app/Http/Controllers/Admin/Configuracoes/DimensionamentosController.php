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

        modalSucesso('Dados atualizados com sucesso.');
        return redirect()->back();
    }
}
