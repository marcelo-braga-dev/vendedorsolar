<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orcamento\CadastrarOrcamentoRequest;
use App\Http\Requests\Orcamento\ConvencionalRequest;
use App\Models\Clientes;
use App\Models\Produtos;
use App\src\Orcamentos\Dimensionamento\Convencional\Convencional;
use App\src\Orcamentos\Dimensionamento\Convencional\ConvencionalDados;
use App\src\Orcamentos\DirecaoInstalacao;
use App\src\Orcamentos\Orcamento;
use function GuzzleHttp\Promise\all;

class DimenConvencionalController extends Controller
{
    public function index()
    {
        $clientes = (new Clientes())->newQuery()
            ->orderBy('id', 'DESC')
            ->where('users_id', '=', id_usuario_atual())->get();

        $orientacoes = (new DirecaoInstalacao())->direcoes();

        return view('pages.vendedor.orcamentos.dimensionamento.convencional',
            compact('clientes', 'orientacoes'));
    }

    public function create(ConvencionalRequest $request)
    {
        $conv = new Convencional(new ConvencionalDados($request));
        $kits = $conv->selecionarKits();

        $produtos = (new Produtos())->getDados();

        return view('pages.vendedor.orcamentos.dimensionamento.components.lista-kits',
            compact('kits', 'request', 'produtos'));
    }

    public function store(CadastrarOrcamentoRequest $request)
    {
        try {
            $id = (new Orcamento())->cadastrar($request);
            return redirect()->route('vendedor.orcamento.show', $id);
        } catch (\DomainException $e) {
            modalErro($e->getMessage());
            return redirect()->route('vendedor.dimensionamento.convencional.index');
        }
    }
}
