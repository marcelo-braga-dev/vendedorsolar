<?php

namespace App\Http\Controllers\Admin\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\OrcamentosVistorias;
use App\Services\Orcamentos\VistoriaService;
use Illuminate\Http\Request;

class VistoriaController extends Controller
{
    public function show($id)
    {
        $vistoriaOrcamentos = new OrcamentosVistorias();
        $vistoria = $vistoriaOrcamentos->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->first();

        return view('pages.admin.orcamentos.vistoria.show', compact('id', 'vistoria'));
    }

    public function store(Request $request)
    {
        (new VistoriaService())->imagens($request);
        modalSucesso('Dados atualizados com sucesso!');
        return redirect()->back();
    }
}
