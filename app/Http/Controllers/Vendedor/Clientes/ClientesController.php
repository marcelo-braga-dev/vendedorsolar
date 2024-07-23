<?php

namespace App\Http\Controllers\Vendedor\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\User;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index(Request $request)
    {
        $clientes = (new Clientes())->newQuery()
            ->where('users_id', '=', id_usuario_atual())
            ->orderBy('id', 'DESC')->get();

        return view('pages.vendedor.clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('pages.vendedor.clientes.create');
    }

    public function store(Request $request)
    {
        (new Clientes())->cadastrar($request);

        return redirect()->route('vendedor.clientes.index');
    }

    public function show($id)
    {
        $cliente = (new Clientes())->pesquisar($id);
        $dados = (new ClientesMetas())->values($cliente->id);

        return view('pages.vendedor.clientes.show', compact('cliente', 'dados'));
    }

    public function edit($id)
    {
        $cliente = (new Clientes())->pesquisar($id);
        $dados = (new ClientesMetas())->values($cliente->id);

        return view('pages.vendedor.clientes.edit', compact('cliente', 'dados'));
    }

    public function update(Request $request, $id)
    {
        (new Clientes())->atualizar($request, $id);

        return redirect()->back();
    }
}
