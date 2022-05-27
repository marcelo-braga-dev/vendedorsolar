<?php

namespace App\Http\Controllers\Admin\Fornecedores;

use App\Http\Controllers\Controller;
use App\Models\Fornecedores;
use App\Models\Kits;
use App\Models\Produtos;
use Illuminate\Http\Request;

class FornecedoresController extends Controller
{
    public function index()
    {
        $fornecedores = new Fornecedores();
        $fornecedores = $fornecedores->get();

        return view('pages.admin.fornecedores.index', compact('fornecedores'));
    }

    public function create()
    {
        return view('pages.admin.fornecedores.create');
    }

    public function store(Request $request)
    {
        $fornecedor = new Fornecedores();
        $fornecedor->cadastrar($request);

        modalSucesso('Fornecedor cadastrado com sucesso.');

        return redirect()->route('admin.fornecedores.index');
    }

    public function show($id)
    {
        $fornecedores = new Fornecedores();
        $fornecedor = $fornecedores->newQuery()->findOrFail($id);

        return view('pages.admin.fornecedores.show', compact('fornecedor'));
    }

    public function edit($id)
    {
        $fornecedores = new Fornecedores();
        $fornecedor = $fornecedores->newQuery()
            ->findOrFail($id);

        return view('pages.admin.fornecedores.edit', compact('fornecedor'));
    }

    public function update(Request $request, $id)
    {
        $fornecedores = new Fornecedores();
        $fornecedores->atualizar($request, $id);

        modalSucesso('Dados atualizados com sucesso.');

        return redirect()->route('admin.fornecedores.show', $id);
    }

    public function destroy($id)
    {
        $kits = new Kits();
        $kit = $kits->newQuery()
            ->where('fornecedor', '=', $id)
            ->exists();

        if ($kit) {
            modalErro('Não é possível excuir pois existe kits cadastrado com esse fornecedor.');
            return redirect()->back();
        }

        $produtos = new Fornecedores();
        $marca = $produtos->newQuery()->find($id);
        $marca->delete();

        modalSucesso('Fornecedor deletado com sucesso.');
        return redirect()->route('admin.fornecedores.index');
    }
}

















