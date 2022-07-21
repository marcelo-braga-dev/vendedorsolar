<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orcamento\CadastrarOrcamentoRequest;
use App\Http\Requests\Orcamento\DemandaRequest;
use App\Models\Clientes;
use App\Models\Concessionarias;
use App\Models\Produtos;
use App\src\Orcamentos\Dimensionamento\Demanda\Demanda;
use App\src\Orcamentos\Dimensionamento\Demanda\DemandaDados;
use App\src\Orcamentos\DirecaoInstalacao;
use App\src\Orcamentos\Orcamento;

class DimenDemandaController extends Controller
{
    public function index()
    {
        $clsClientes = new Clientes();
        $clientes = $clsClientes->newQuery()
            ->where('users_id', '=', id_usuario_atual())
            ->orderBy('id', 'DESC')
            ->get();

        $clsConcessionarias = new Concessionarias();
        $concessionarias = $clsConcessionarias->newQuery()
            ->get(['id', 'nome', 'estado']);

        $orientacoes = (new DirecaoInstalacao())->direcoes();

        return view('pages.vendedor.orcamentos.dimensionamento.demanda',
            compact('clientes', 'orientacoes', 'concessionarias'));
    }

    public function create(DemandaRequest $request)
    {
        $demanda = new Demanda(new DemandaDados($request));
        $kits = $demanda->selecionarKits();

        $produtos = new Produtos();
        $produtos = $produtos->getDados();

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
        }
    }
}
