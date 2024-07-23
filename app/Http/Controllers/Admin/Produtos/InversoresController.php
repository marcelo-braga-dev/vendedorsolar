<?php

namespace App\Http\Controllers\Admin\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Kits;
use App\Models\Produtos;
use Illuminate\Http\Request;

class InversoresController extends Controller
{
    public function index()
    {
        $inversores = (new Produtos())->inversores();

        return view('pages.admin.produtos.inversores.index', compact('inversores'));
    }

    public function create()
    {
        return view('pages.admin.produtos.inversores.create');
    }

    public function store(Request $request)
    {
        $produtos = new Produtos();

        $produtos->tipo = 'inversor';
        $produtos->nome = $this->verificaNome($request->nome, $request->categoria);
        $produtos->categoria = $request->categoria;
        $produtos->garantia = $request->garantia;
        $this->uploadImagens($request, $produtos);
        $produtos->push();

        modalSucesso('Marca cadastrada com sucesso.');
        return redirect()->route('admin.produtos.inversores.index');
    }

    private function verificaNome($nome, $categoria)
    {
        if (strpos($nome, '(Convencional)') === false && $categoria == 'convencional') {
            return $nome . ' (Convencional)';
        }

        if (strpos($nome, '(Microinvesor)') === false && $categoria == 'microinversor') {
            return $nome . ' (Microinvesor)';
        }

        return $nome;
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $produtos = new Produtos();
        $inversor = $produtos->newQuery()
            ->findOrFail($id);

        return view('pages.admin.produtos.inversores.edit', compact('inversor'));
    }

    public function update(Request $request, $id)
    {
        $inversores = new Produtos();
        $inversor = $inversores->newQuery()->findOrFail($id);

        $inversor->nome = $this->verificaNome($request->nome, $request->categoria);
        $inversor->garantia = $request->garantia;
        $inversor->categoria = $request->categoria;

        $this->uploadImagens($request, $inversor);

        $inversor->push();

        modalSucesso('Informações atualizadas com sucesso!');

        return redirect()->route('admin.produtos.inversores.index');
    }

    public function destroy($id)
    {
        $kits = new Kits();
        $kit = $kits->newQuery()
            ->where('marca_inversor', '=', $id)
            ->exists();

        if ($kit) {
            modalErro('Não é possível excuir pois existe kits cadastrado com essa marca.');
            return redirect()->back();
        }

        $produtos = new Produtos();
        $marca = $produtos->newQuery()->find($id);

        deleteFileStorage($marca->img_logo);
        deleteFileStorage($marca->img_produto);

        $marca->delete();

        modalSucesso('Marca deletada com sucesso.');

        return redirect()->route('admin.produtos.inversores.index');
    }

    private function uploadImagens(Request $request, $inversor): void
    {
        if ($request->hasFile('img_logo')) {
            if ($request->file('img_logo')->isValid()) {
                deleteFileStorage($inversor->img_logo);

                $inversor->img_logo = $request->img_logo->store('produtos');
            }
        }

        if ($request->hasFile('img_produto')) {
            if ($request->file('img_produto')->isValid()) {
                deleteFileStorage($inversor->img_produto);
                $inversor->img_produto = $request->img_produto->store('produtos');
            }
        }
    }
}
