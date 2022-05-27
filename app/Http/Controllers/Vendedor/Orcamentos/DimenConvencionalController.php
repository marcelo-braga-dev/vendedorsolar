<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orcamento\CadastrarOrcamentoRequest;
use App\Http\Requests\Orcamento\ConvencionalRequest;
use App\Models\Clientes;
use App\Models\DadosDimensionamento;
use App\Models\Produtos;
use App\src\Orcamentos\Dimensionamento\Convencional\Convencional;
use App\src\Orcamentos\Dimensionamento\Convencional\ConvencionalDados;
use App\src\Orcamentos\Orcamento;

class DimenConvencionalController extends Controller
{
    public function index()
    {
        $clientes = Clientes::orderBy('id', 'DESC')
            ->where('users_id', '=', id_usuario_atual())
            ->get();

        $dadosDimensionamento = new DadosDimensionamento();
        $orientacoes = $dadosDimensionamento->getOrientacoes();

        return view('pages.vendedor.orcamentos.dimensionamento.convencional',
            compact('clientes', 'orientacoes'));
    }

    public function create(ConvencionalRequest $request)
    {
        $conv = new Convencional(new ConvencionalDados($request));
        $kits = $conv->selecionarKits();

        $produtos = new Produtos();
        $produtos = $produtos->getImagensNome();

        return view('pages.vendedor.orcamentos.dimensionamento.components.lista-kits',
            compact('kits', 'request', 'produtos'));
    }

    public function store(CadastrarOrcamentoRequest $request)
    {
        try {
            $orcamento = new Orcamento();
            $id = $orcamento->cadastrar($request);

            return redirect()->route('vendedor.orcamento.show', $id);
        } catch (\DomainException $e) {
            return redirect()->back();
            //return redirect()->route('vendedor.dimensionamento.convencional.index');
        }
    }
}
