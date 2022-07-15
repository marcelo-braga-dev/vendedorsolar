<?php

namespace App\Http\Controllers\Vendedor\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\User;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $user = new User();
        $clientes = $user->clientes(id_usuario_atual());

        return view('pages.vendedor.clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('pages.vendedor.clientes.create');
    }

    public function store(Request $request)
    {
        $cliente = new Clientes();
        $cliente->cadastrar($request);

        return redirect()->route('vendedor.clientes.index');
    }

    public function show($id)
    {
        $clientes = new Clientes();
        $cliente = $clientes->pesquisar($id);

        $meta = new ClientesMetas();
        $dados = $meta->values($cliente->id);

        return view('pages.vendedor.clientes.show', compact('cliente', 'dados'));
    }

    public function edit($id)
    {
        $clientes = new Clientes();
        $cliente = $clientes->pesquisar($id);

        $meta = new ClientesMetas();
        $dados = $meta->values($cliente->id);

        return view('pages.vendedor.clientes.edit', compact('cliente', 'dados'));
    }

    public function update(Request $request, $id)
    {
        $cliente = new Clientes();
        $cliente->atualizar($request, $id);

        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
