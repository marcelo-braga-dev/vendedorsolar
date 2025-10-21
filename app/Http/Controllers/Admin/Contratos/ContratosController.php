<?php

namespace App\Http\Controllers\Admin\Contratos;

use App\Models\Clientes;
use App\Models\Contratos;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\OrcamentosInfos;
use App\Models\OrcamentosKits;
use App\Models\Produtos;
use App\Models\User;
use App\src\Contratos\Constructor;
use Illuminate\Http\Request;

class ContratosController
{
    public function index()
    {
        $items = (new Contratos())->newQuery()->orderByDesc('id')->get();
        $vendedor = User::query()->pluck('name', 'id');

        return view('pages.admin.contratos.index', compact('items', 'vendedor'));
    }

    public function edit($id)
    {
        $orcamento = (new Orcamentos())->newQuery()->findOrFail($id);
        $cliente = (new Clientes())->find($orcamento->clientes_id);

        return view('pages.admin.contratos.create',
            compact('orcamento', 'cliente'));
    }

    public function store(Request $request)
    {
        $dados = (new Contratos());
        $dados->orcamentos_id = $request->id;
        $dados->users_id = id_usuario_atual();
        $dados->nome_cliente = $request->nome;
        $dados->documento_cliente = $request->documento;
        $dados->endereco = $request->endereco;
        $dados->push();

        return redirect()->route('admin.contratos.show', $dados->id);
    }

    public function show($id)
    {
        $contrato = (new Contratos())->newQuery()->findOrFail($id);

        return view('pages.admin.contratos.show', compact('contrato'));
    }
}
