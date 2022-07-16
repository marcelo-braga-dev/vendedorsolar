<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Http\Controllers\Controller;
use App\Models\Estruturas;
use App\Models\MargemVendaEstruturas;
use App\Models\MargemVendaPorVendedor;
use App\Models\User;
use Illuminate\Http\Request;

class MargemPorEstruturaController extends Controller
{
    public function index()
    {
        $clsEstruturas = new Estruturas();
        $estruturas = $clsEstruturas->newQuery()->get();

        $margemVenda = new MargemVendaEstruturas();
        $margens = $margemVenda->newQuery()->orderBy('estruturas_id')->get();

        $nomeEstruturas = [];
        foreach ($estruturas as $estrutura) {
            $nomeEstruturas[$estrutura->id] = $estrutura->nome;
        }

        return view('pages.admin.precificacao.margem-estrutura.index',
            compact('estruturas', 'margens', 'nomeEstruturas'));
    }

    public function store(Request $request)
    {
        $margemEstruturas = new MargemVendaEstruturas();
        $margemEstruturas->newQuery()
            ->updateOrInsert(
                ['estruturas_id' => $request->estrutura],
                ['margem' => $request->margem, 'updated_at' => now()]
            );

        modalSucesso('Margem atualizada com sucesso!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $margemEstruturas = new MargemVendaEstruturas();
        $margemEstruturas->newQuery()
            ->findOrFail($id)
            ->delete();

        modalSucesso('Margem deletada com sucesso!');
        return redirect()->back();
    }
}
