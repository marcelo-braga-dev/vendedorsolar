<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Http\Controllers\Controller;
use App\Models\PrecificacaoMetas;
use Illuminate\Http\Request;

class MargemEstadoController extends Controller
{
    public function index()
    {
        $margens = (new PrecificacaoMetas())->getEstados();
        return view('pages.admin.precificacao.margem-estado.index',
            compact('margens'));
    }

    public function store(Request $request)
    {
        (new PrecificacaoMetas())->updateEstados($request);
        modalSucesso('Dados atualizados com sucesso!');
        return redirect()->back();
    }
}
