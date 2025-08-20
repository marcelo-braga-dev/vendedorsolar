<?php

namespace App\Http\Controllers\Vendedor\Orcamentos\Servicos;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Repositories\Propostas\Servicos\ServicosRepository;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    public function index()
    {
        $propostas = (new ServicosRepository)->allVendedor();

        return view('pages.vendedor.orcamentos.servicos.index', compact('propostas'));
    }

    public function show($id)
    {
        $proposta = (new ServicosRepository)->find($id);

        return view('pages.vendedor.orcamentos.servicos.show', compact('proposta'));
    }

    public function create()
    {
        $clientes = (new Clientes())->newQuery()
            ->orderBy('id', 'DESC')
            ->where('users_id', '=', id_usuario_atual())
            ->get();

        return view('pages.vendedor.orcamentos.servicos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $id = (new ServicosRepository())->create($request->all());

        return redirect()->route('vendedor.servicos.show', $id);
    }
}
