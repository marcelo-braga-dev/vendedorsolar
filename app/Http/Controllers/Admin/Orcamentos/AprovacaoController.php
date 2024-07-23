<?php

namespace App\Http\Controllers\Admin\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\OrcamentosAprovacoes;
use App\Services\Orcamentos\DadosAprovacaoService;
use Illuminate\Http\Request;

class AprovacaoController extends Controller
{
    public function show($id)
    {
        $items = (new OrcamentosAprovacoes())->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->get(['meta', 'value']);

        $dados = [];
        foreach ($items as $item) {
            $dados[$item['meta']] = $item['value'];
        }

        return view('pages.admin.orcamentos.aprovacao.show', compact('id', 'dados'));
    }

    public function update($id, Request $request)
    {
        $dados = $request->except(
            ['_token', 'id']
        );

        $aprovacao = new OrcamentosAprovacoes();

        foreach ($dados as $index => $dado) {
            $aprovacao->newQuery()
                ->updateOrInsert(
                    ['orcamentos_id' => $id, 'meta' => $index],
                    ['value' => $dado]
                );
        }

        (new DadosAprovacaoService())->imagens($request, $id);

        modalSucesso('Dados enviados com sucesso!');
        return redirect()->back();
    }
}
