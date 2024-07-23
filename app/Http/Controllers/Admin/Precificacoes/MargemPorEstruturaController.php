<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Http\Controllers\Controller;
use App\Models\Estruturas;
use App\Models\PrecificacaoMetas;
use App\src\Precificacao\MargemEstruturas;
use Illuminate\Http\Request;

class MargemPorEstruturaController extends Controller
{
    public function index()
    {
        $estruturas = (new Estruturas())->newQuery()->get();
        $margens = (new PrecificacaoMetas())->getDados((new MargemEstruturas())->getChave());

        $nomeEstruturas = [];
        foreach ($estruturas as $estrutura) {
            $nomeEstruturas[$estrutura->id] = $estrutura->nome;
        }

        return view('pages.admin.precificacao.margem-estrutura.index',
            compact('estruturas', 'margens', 'nomeEstruturas'));
    }

    public function store(Request $request)
    {
        $chave = (new MargemEstruturas())->getChave();
        (new PrecificacaoMetas())->criar($chave, $request->estrutura, $request->margem);

        modalSucesso('Margem atualizada com sucesso!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        (new PrecificacaoMetas())->deletar($id);

        modalSucesso('Margem deletada com sucesso!');
        return redirect()->back();
    }
}
