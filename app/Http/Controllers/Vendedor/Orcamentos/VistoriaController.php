<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\OrcamentosInfos;
use App\Models\OrcamentosVistorias;
use App\Services\Orcamentos\VistoriaService;
use Illuminate\Http\Request;

class VistoriaController extends Controller
{
    public function show($id)
    {
        $vistoria = (new OrcamentosVistorias())->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->first();
        $disabled = (new OrcamentosInfos())->statusBloqueio($id);

        return view('pages.vendedor.orcamentos.vistoria.show',
            compact('id', 'vistoria', 'disabled'));
    }

    public function store(Request $request)
    {
        (new VistoriaService())->imagens($request);
        modalSucesso('Dados atualizados com sucesso!');
        return redirect()->back();
    }
}
