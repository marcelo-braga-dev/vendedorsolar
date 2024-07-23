<?php

namespace App\Http\Controllers\Admin\Financeiros;

use App\Http\Controllers\Controller;
use App\Models\TaxaComissoes;
use App\Models\User;
use Illuminate\Http\Request;

class ComissaoVendaController extends Controller
{
    public function index()
    {
        $usuarios = (new User())->vendedoresPaginate();
        $items = (new TaxaComissoes())->newQuery()->get();

        $comissoes = [];
        foreach ($items as $item) {
            $comissoes[$item->user_id] = $item->taxa;
        }

        return view('pages.admin.financeiro.comissao-venda.index',
            compact('usuarios', 'comissoes'));
    }

    public function edit($id)
    {
        $comissao = (new TaxaComissoes())->newQuery()
            ->where('user_id', '=', $id)->first();

        return view('pages.admin.financeiro.comissao-venda.edit', compact('comissao', 'id'));
    }

    public function update(Request $request, $id)
    {
        (new TaxaComissoes())->newQuery()
            ->updateOrInsert(
                ['user_id' => $id],
                ['taxa' => $request->taxa_comissao]
            );
        modalSucesso('Taxas de comissão atualizadas com sucesso.');

        return redirect()->route('admin.financeiro.comissao-venda.edit', $id);
    }
}
