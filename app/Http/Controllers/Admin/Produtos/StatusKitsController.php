<?php

namespace App\Http\Controllers\Admin\Produtos;

use App\Http\Controllers\Controller;
use App\Models\Fornecedores;
use App\Models\Kits;
use App\Models\Produtos;
use Illuminate\Http\Request;

class StatusKitsController extends Controller
{
    public function index(Request $request)
    {
        $kits = [];
        $marcas = [];
        $fornecedor = '';

        $fornecedores = (new Fornecedores())->newQuery()->get();

        if (!$fornecedores->isEmpty()) {
            $fornecedor = $request->id ?? $fornecedores[0]->id;

            $clsKits = new Kits();
            $items = $clsKits->fornecedor($fornecedor);

            foreach ($items as $item) {
                $kits[$item->marca_inversor][$item->marca_painel][$item->potencia_painel] = $item;
            }
        }

        $nomeFornecedor = (new Fornecedores())->newQuery()->find($fornecedor)->nome ?? '';

        $produtos = (new Produtos())->newQuery()
            ->get(['id', 'nome', 'img_logo']);

        foreach ($produtos as $item) {
            $marcas[$item->id] = ['nome' => $item->nome, 'logo' => $item->img_logo];
        }

        return view('pages.admin.produtos.status-kits.index',
            compact('kits', 'marcas', 'fornecedor', 'fornecedores', 'nomeFornecedor'));
    }

    public function update(Request $request)
    {
        $kits = new Kits();

        $kits->updateStatus($request->fornecedor, $request->potencia, $request->inversor, $request->painel, $request->status);
    }
}
