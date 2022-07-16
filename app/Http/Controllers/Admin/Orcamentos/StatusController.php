<?php

namespace App\Http\Controllers\Admin\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\Orcamentos;
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
        (new Orcamentos)->newQuery()
            ->find($id)->update(['status' => $request->status]);

        modalSucesso('Informações atualizadas com sucesso.');

        return redirect()->route('admin.orcamentos.update', $id);
    }
}
