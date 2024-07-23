<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Http\Controllers\Controller;
use App\Models\PrecificacaoMetas;
use App\src\Precificacao\MargemEstados;
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
        $dados = $request->except('_token');
        $chave = (new MargemEstados())->getChave();

        foreach ($dados as $index => $dado) {
            (new PrecificacaoMetas())->criar($chave, $index, $dado);
        }
        modalSucesso('Dados atualizados com sucesso!');
        return redirect()->back();
    }
}
