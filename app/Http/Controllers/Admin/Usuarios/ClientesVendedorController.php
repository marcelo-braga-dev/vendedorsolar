<?php

namespace App\Http\Controllers\Admin\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\ClientesMetas;
use Illuminate\Http\Request;

class ClientesVendedorController extends Controller
{
    public function index($id)
    {
        $clientes = (new Clientes())->newQuery()
            ->where('users_id', $id)
            ->orderBy('id', 'DESC')->get();

        return view('pages.admin.usuarios.vendedores.clientes.index', compact('clientes'));
    }

    public function show($id)
    {
        $cliente = (new Clientes())->newQuery()->find($id);
        $dados = (new ClientesMetas())->values($cliente->id);

        return view('pages.admin.usuarios.vendedores.clientes.show', compact('cliente', 'dados'));
    }

    public function edit($id)
    {
        $cliente = (new Clientes())->newQuery()->find($id);
        $dados = (new ClientesMetas())->values($cliente->id);

        return view('pages.admin.usuarios.vendedores.clientes.edit', compact('cliente', 'dados'));
    }

    public function update($id, Request $request)
    {
        (new Clientes())->atualizar($request, $id);

        return redirect()->back();
    }
}
