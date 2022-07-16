<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Http\Controllers\Controller;
use App\Models\MargensVenda;
use App\src\Produtos\Precificacao\MargemPadrao;
use Illuminate\Http\Request;

class MargemPrincipalController extends Controller
{
    public function index()
    {
        $margensVendas = new MargensVenda();
        $margens = $margensVendas->padrao();

        return view('pages.admin.precificacao.margem-principal.index', compact('margens'));
    }

    public function store(Request $request)
    {
        $margensVendas = new MargensVenda();
        $margensVendas->newQuery()
            ->updateOrInsert(
                ['nome' => 'padrao', 'potencia' => $request->potencia], [
                    'potencia' => $request->potencia, 'margem' => $request->margem,
                    'created_at' => now(), 'updated_at' => now()
                ]
            );
        modalSucesso('Atualização realizada com sucesso.');

        $margem = new MargemPadrao();
        $margem->atualizaPrecoMargemPagrao();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $margensVendas = new MargensVenda();
        $margensVendas->newQuery()
            ->findOrFail($id)
            ->delete();

        $margem = new MargemPadrao();
        $margem->atualizaPrecoMargemPagrao();

        return redirect()->back();
    }
}
