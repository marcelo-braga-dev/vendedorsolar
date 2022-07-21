<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\AprovacaoOrcamentos;
use App\Models\Orcamentos;
use App\Models\OrcamentosInfos;
use App\Models\OrcamentosMetas;
use App\Services\Orcamentos\DadosAprovacaoService;
use App\src\Orcamentos\Status\Assinado;
use Illuminate\Http\Request;

class AprovacaoController extends Controller
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
        $disabled = (new OrcamentosInfos())->statusBloqueio($id);

        return view('pages.vendedor.orcamentos.aprovacao.show',
            compact('id', 'dados', 'disabled'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $dados = $request->except(['_token', 'id']);

        (new AprovacaoOrcamentos())->criar($id, $dados);
        (new DadosAprovacaoService())->imagens($request, $id);
        (new Orcamentos())->alterarStatus($id, new Assinado());
        (new OrcamentosInfos())->bloquear($id, true);

        modalSucesso('Dados enviados com sucesso!');
        return redirect()->back();
    }
}
