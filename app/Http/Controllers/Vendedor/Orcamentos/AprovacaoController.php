<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\OrcamentosAprovacoes;
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
        $valores = (new OrcamentosAprovacoes())->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->get(['meta', 'value']);

        $dados = [];
        foreach ($valores as $valor) {
            $dados[$valor['meta']] = $valor['value'];
        }
        $disabled = (new OrcamentosInfos())->statusBloqueio($id);

        $orcamento = (new Orcamentos())->newQuery()->find($id);
        if ($orcamento) {
            $cliente = (new Clientes())->newQuery()->find($orcamento->clientes_id);
            $clienteMetas = (new ClientesMetas())->values($cliente->id);
        }

        return view('pages.vendedor.orcamentos.aprovacao.show',
            compact('id', 'dados', 'disabled', 'cliente', 'clienteMetas'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $dados = $request->except(['_token', 'id']);

        (new OrcamentosAprovacoes())->criar($id, $dados);
        (new DadosAprovacaoService())->imagens($request, $id);
        (new Orcamentos())->alterarStatus($id, new Assinado());
        (new OrcamentosInfos())->bloquear($id, true);

        modalSucesso('Dados enviados com sucesso!');
        return redirect()->back();
    }
}
