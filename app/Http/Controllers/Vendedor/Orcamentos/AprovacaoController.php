<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Models\AprovacaoOrcamentos;
use App\Models\Orcamentos;
use App\Services\Orcamentos\DadosAprovacaoService;
use App\src\Orcamentos\Status\Assinado;
use Illuminate\Http\Request;

class AprovacaoController
{
    public function show($id)
    {
        $valores = (new AprovacaoOrcamentos())->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->get(['meta', 'value']);

        $dados = [];
        foreach ($valores as $valor) {
            $dados[$valor['meta']] = $valor['value'];
        }
        return view('pages.vendedor.orcamentos.aprovacao.show', compact('id', 'dados'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $dados = $request->except(['_token', 'id']);

        $aprovacao = (new AprovacaoOrcamentos())->newQuery();

        foreach ($dados as $index => $dado) {
            $aprovacao->updateOrInsert(
                ['orcamentos_id' => $id, 'meta' => $index],
                ['value' => $dado]
            );
        }

        (new DadosAprovacaoService())->imagens($request, $id);

        (new Orcamentos())->newQuery()
            ->find($id)
            ->update(['status' => (new Assinado())->getStatus()]);

        modalSucesso('Dados enviados com sucesso!');
        return redirect()->back();
    }
}
