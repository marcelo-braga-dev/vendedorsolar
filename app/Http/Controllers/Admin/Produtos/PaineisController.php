<?php

namespace App\Http\Controllers\Admin\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Kits;
use App\Models\Produtos;
use Illuminate\Http\Request;

class PaineisController extends Controller
{
    public function index()
    {
        $produtos = new Produtos();
        $paineis = $produtos->paineis();

        return view('pages.admin.produtos.paineis.index', compact('paineis'));
    }

    public function create()
    {
        return view('pages.admin.produtos.paineis.create');
    }

    public function store(Request $request)
    {
        $produtos = new Produtos();

        $produtos->tipo = 'painel';
        $produtos->nome = $request->nome;
        $produtos->garantia = $request->garantia;
        $this->uploadImagem($request, $produtos);
        $produtos->push();

        modalSucesso('Marca cadastrada com sucesso.');
        return redirect()->route('admin.produtos.paineis.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $produto = (new Produtos())->newQuery()->findOrFail($id);

        return view('pages.admin.produtos.paineis.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $paineis = new Produtos();
        $painel = $paineis->newQuery()->findOrFail($id);
        $painel->nome = $request->nome;
        $painel->garantia = $request->garantia;
        $this->uploadImagem($request, $painel);
        $painel->push();

        modalSucesso('Informações atualizadas com sucesso!');

        return redirect()->route('admin.produtos.paineis.index');
    }

    public function destroy($id)
    {
        $kit = (new Kits())->newQuery()
            ->where('marca_painel', '=', $id)
            ->exists();

        if ($kit) {
            modalErro('Não é possível excluir pois existe kits cadastrado com essa marca.');
            return redirect()->back();
        }

        $produtos = new Produtos();
        $marca = $produtos->newQuery()->find($id);

        deleteFileStorage($marca->img_logo);
        deleteFileStorage($marca->img_produto);

        $marca->delete();

        modalSucesso('Marca deletada com sucesso.');

        return redirect()->route('admin.produtos.paineis.index');
    }

    private function uploadImagem(Request $request, $painel): void
    {
        if ($request->hasFile('img_logo')) {
            if ($request->file('img_logo')->isValid()) {
                deleteFileStorage($painel->img_logo);

                $painel->img_logo = $request->img_logo->store('produtos');
            }
        }

        if ($request->hasFile('img_produto')) {
            if ($request->file('img_produto')->isValid()) {
                deleteFileStorage($painel->img_produto);
                $painel->img_produto = $request->img_produto->store('produtos');
            }
        }
    }
}
