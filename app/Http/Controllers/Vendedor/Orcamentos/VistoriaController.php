<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\VistoriaOrcamentos;
use App\Services\Orcamentos\VistoriaService;
use Illuminate\Http\Request;

class VistoriaController extends Controller
{
    public function show($id)
    {
        $vistoria = (new VistoriaOrcamentos())->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->first();

        return view('pages.vendedor.orcamentos.vistoria.show', compact('id', 'vistoria'));
    }

    public function store(Request $request)
    {
        (new VistoriaService())->imagens($request);
        modalSucesso('Dados atualizados com sucesso!');
        return redirect()->back();
    }
}
