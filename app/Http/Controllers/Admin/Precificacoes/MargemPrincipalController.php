<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Http\Controllers\Controller;
use App\Models\PrecificacaoPrincipal;
use Illuminate\Http\Request;

class MargemPrincipalController extends Controller
{
    public function index()
    {
        $margens = (new PrecificacaoPrincipal())->padrao();

        return view('pages.admin.precificacao.margem-principal.index', compact('margens'));
    }

    public function store(Request $request)
    {
        (new PrecificacaoPrincipal())->cadastrar($request);

        modalSucesso('Atualização realizada com sucesso.');

        return redirect()->back();
    }

    public function destroy($id)
    {
        (new PrecificacaoPrincipal())->newQuery()->findOrFail($id)->delete();

        return redirect()->back();
    }
}
