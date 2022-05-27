<?php

namespace App\Http\Controllers\Admin\Produtos;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormCadastroKitRequest;
use App\Models\Estruturas;
use App\Models\Fornecedores;
use App\Models\Kits;
use App\Models\Produtos;
use App\src\Produtos\CadastrarKit;
use Illuminate\Http\Request;

class KitsController extends Controller
{
    public function index(Request $request)
    {
        $where = [];

        if ($request->estrutura) $where[] = ['estrutura', '=', $request->estrutura];
        if ($request->fornecedor) $where[] = ['fornecedor', '=', $request->fornecedor];
        if ($request->inversor) $where[] = ['marca_inversor', '=', $request->inversor];
        if ($request->painel) $where[] = ['marca_painel', '=', $request->painel];
        if ($request->status !== null) $where[] = ['status', '=', $request->status];
        if ($request->status_fornecedor !== null) $where[] = ['status_fornecedor', '=', $request->status_fornecedor];
        if ($request->id) $where = [['id', '=', $request->id]];

        $clsKits = new Kits();

        $kits = $clsKits
            ->where($where)
            ->orderby('id', 'DESC')
            ->paginate(20);

        $fornecedores = (new Fornecedores())->fornecedores();

        $produtos = new Produtos();
        $inversores = $produtos->inversores();
        $paineis = $produtos->paineis();

        return view('pages.admin.produtos.kits.index',
            compact('kits', 'fornecedores', 'request', 'inversores', 'paineis'));
    }

    public function create()
    {
        $estruturas = Estruturas::orderBy('nome', 'ASC')->get();
        $fornecedores = Fornecedores::orderBy('nome', 'ASC')->get(['id', 'nome']);
        $produtos = Produtos::orderBy('nome', 'ASC')->get(['id', 'tipo', 'nome', 'categoria']);

        foreach ($produtos as $arg) {
            $marcas[$arg->id] = $arg->nome;
        }

        return view(
            'pages.admin.produtos.kits.create',
            compact('estruturas', 'fornecedores', 'produtos', 'marcas')
        );
    }

    public function store(FormCadastroKitRequest $request)
    {
        $cadastrar = new CadastrarKit($request);
        $cadastrar->cadastrarKit();

        return redirect()->back();
    }
}
