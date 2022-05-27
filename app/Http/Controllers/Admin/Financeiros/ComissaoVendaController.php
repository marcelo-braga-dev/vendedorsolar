<?php

namespace App\Http\Controllers\Admin\Financeiros;

use App\Models\TaxaComissoes;
use App\Models\User;
use Illuminate\Http\Request;

class ComissaoVendaController
{
    public function index()
    {
        $comissoes = [];
        $user = new User();
        $usuarios = $user->vendedores();

        $taxaComissoes = new TaxaComissoes();
        $items = $taxaComissoes->newQuery()->get();

        foreach ($items as $item) {
            $comissoes[$item->user_id] = $item->taxa;
        }

        return view('pages.admin.financeiro.comissao-venda.index', compact('usuarios', 'comissoes'));
    }

    public function edit($id)
    {
        $taxaComissoes = new TaxaComissoes();
        $comissao = $taxaComissoes->newQuery()
            ->where('user_id', '=', $id)
            ->first();

        return view('pages.admin.financeiro.comissao-venda.edit', compact('comissao', 'id'));
    }

    public function update(Request $request, $id)
    {
        $taxaComissoes = new TaxaComissoes();
        $taxaComissoes->newQuery()
            ->updateOrInsert(
                ['user_id' => $id],
                ['taxa' => $request->taxa_comissao]
            );
        
        modalSucesso('Taxas de comissão atualizadas com sucesso.');

        return redirect()->route('admin.financeiro.comissao-venda.edit', $id);
    }
}
