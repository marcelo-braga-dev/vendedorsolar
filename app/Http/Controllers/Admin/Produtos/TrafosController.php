<?php

namespace App\Http\Controllers\Admin\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Produtos;
use App\Models\Trafos;
use Illuminate\Http\Request;

class TrafosController extends Controller
{
    public function index()
    {
        $trafos = (new Trafos())->newQuery()
            ->orderBy('potencia')
            ->get();
        $img = (new Produtos())->trafos();

        return view('pages.admin.produtos.trafos.index', compact('trafos', 'img'));
    }

    public function create()
    {
        // Usado para o form de editar
        $produtos = new Produtos();
        $marca = $produtos->newQuery()
            ->where('tipo', '=', 'trafo')
            ->first();

        return view('pages.admin.produtos.trafos.create', compact('marca'));
    }

    public function store(Request $request)
    {
        $produtos = new Produtos();

        $produtos->create([
            'tipo' => 'trafo',
            'nome' => $request->nome,
            'categoria' => $request->categoria,
            'garantia' => $request->garantia
        ]);

        return redirect()->route('admin.produtos.trafos.index');
    }

    public function show(Request $request, $id)
    {
        //
    }

    public function edit($id)
    {
        $trafos = new Trafos();
        $trafo = $trafos->newQuery()
            ->findOrFail($id);

        return view('pages.admin.produtos.trafos.edit', compact('trafo'));
    }

    public function update(Request $request, $id)
    {
        $precoFornecedor = convert_money_float($request->preco_fornecedor);
        $precoCliente = $precoFornecedor * (1 + $request->margem / 100);

        (new Trafos())->newQuery()
            ->findOrFail($id)
            ->update([
                'modelo' => $request->modelo,
                'preco_fornecedor' => $precoFornecedor,
                'margem' => $request->margem,
                'preco_cliente' => $precoCliente,
                'potencia' => $request->potencia
            ]);

        modalSucesso('Atualização realizada com sucesso!');

        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        // Usado para atualizar marca
        $produtos = new Produtos();
        $trafo = $produtos->newQuery()->findOrFail($id);

        $trafo->nome = $request->nome;
        $trafo->garantia = $request->garantia;
        $this->uploadImagem($request, $trafo);

        $trafo->push();

        modalSucesso('Informações atualizadas com sucesso!');

        return redirect()->back();
    }

    private function uploadImagem(Request $request, $painel): void
    {
        if ($request->hasFile('img_logo')) {
            if ($request->file('img_logo')->isValid()) {
                deleteFileStorage($painel->img_logo);

                $painel->img_logo = $request->img_logo->store('produtos/trafos/logos');
            }
        }

        if ($request->hasFile('img_produto')) {
            if ($request->file('img_produto')->isValid()) {
                deleteFileStorage($painel->img_produto);
                $painel->img_produto = $request->img_produto->store('produtos/trafos/produtos');
            }
        }
    }
}
