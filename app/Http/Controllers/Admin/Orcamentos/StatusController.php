<?php

namespace App\Http\Controllers\Admin\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\Orcamentos;
use App\Models\OrcamentosHistoricos;
use App\src\Orcamentos\Orcamento;
use App\src\Orcamentos\Status\StatusOrcamentos;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function edit($id)
    {
        $orcamento = (new Orcamentos())->newQuery()->findOrFail($id);
        $todosStatus = (new StatusOrcamentos())->todosStatus();

        return view('pages.admin.orcamentos.status.edit', compact('orcamento', 'todosStatus'));
    }

    public function update(Request $request, int $id)
    {
        try {
            $status = (new StatusOrcamentos())->getClassStatus();
            (new Orcamento())->alterarStatus($id, $status[$request->status]);
            (new OrcamentosHistoricos())->criar($id, $request->status, $request->anotacoes);
            modalSucesso('Informações atualizadas com sucesso.');
            return redirect()->route('admin.orcamentos.show', $id);
        } catch (\DomainException $exception) {
            modalErro($exception->getMessage());
            return redirect()->route('admin.orcamento.status.edit', $id);
        }
    }
}
