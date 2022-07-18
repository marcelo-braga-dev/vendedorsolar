<?php

namespace App\Http\Controllers\Admin\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use App\Models\Trafos;
use Illuminate\Http\Request;

class MarcasTrafosController extends Controller
{
    public function index()
    {
        $trafos = (new Produtos())->trafos();
        return view('pages.admin.produtos.trafos.marcas.index', compact('trafos'));
    }

    public function create()
    {
        return view('pages.admin.produtos.trafos.marcas.create');
    }

    public function store(Request $request)
    {
        $produtos = new Produtos();

        $produtos->tipo = 'trafo';
        $produtos->nome = $request->nome;
        $produtos->garantia = $request->garantia;
        $this->uploadImagem($request, $produtos);
        $produtos->push();

        modalSucesso('Marca cadastrada com sucesso.');
        return redirect()->route('admin.produtos.trafos-marcas.index');
    }

    public function edit($id)
    {
        $produto = (new Produtos())->newQuery()->findOrFail($id);

        return view('pages.admin.produtos.trafos.marcas.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $produtos = new Produtos();
        $trafo = $produtos->newQuery()->findOrFail($id);
        $trafo->nome = $request->nome;
        $trafo->garantia = $request->garantia;
        $this->uploadImagem($request, $trafo);
        $trafo->push();

        modalSucesso('Informações atualizadas com sucesso!');

        return redirect()->route('admin.produtos.trafos-marcas.index');
    }

    public function destroy($id)
    {
        $trafo = (new Trafos())->newQuery()
            ->where('produtos_id', $id)->exists();

        if ($trafo) {
            modalErro('Não é possível exlcuir pois existe transformadores cadastrado com essa marca.');
            return redirect()->back();
        }

        $marca = (new Produtos())->newQuery()->find($id);

        deleteFileStorage($marca->img_logo);
        deleteFileStorage($marca->img_produto);

        $marca->delete();

        modalSucesso('Marca deletada com sucesso.');

        return redirect()->route('admin.produtos.trafos-marcas.index');
    }

    private function uploadImagem(Request $request, $marca): void
    {
        if ($request->hasFile('img_logo')) {
            if ($request->file('img_logo')->isValid()) {
                deleteFileStorage($marca->img_logo);

                $marca->img_logo = $request->img_logo->store('produtos');
            }
        }

        if ($request->hasFile('img_produto')) {
            if ($request->file('img_produto')->isValid()) {
                deleteFileStorage($marca->img_produto);
                $marca->img_produto = $request->img_produto->store('produtos');
            }
        }
    }
}
