<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Models\VistoriaOrcamentos;
use Illuminate\Http\Request;

class VistoriaController
{
    public function show($id)
    {
        $vistoriaOrcamentos = new VistoriaOrcamentos();
        $vistoria = $vistoriaOrcamentos->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->first();

        return view('pages.vendedor.orcamentos.vistoria.show', compact('id', 'vistoria'));
    }

    public function store(Request $request)
    {
        $vistoria = new VistoriaOrcamentos();

        // Disjuntor
        if ($request->hasFile('disjuntor')) {
            if ($request->file('disjuntor')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $disjuntor = $request->disjuntor->store('orcamentos/vistoria/' . $request->id);
                $vistoria->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $request->id],
                        ['slug_disjuntor' => $disjuntor,]
                    );
            }
        }

        // Padrao
        if ($request->hasFile('padrao_energia')) {
            if ($request->file('padrao_energia')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $disjuntor = $request->padrao_energia->store('orcamentos/vistoria/' . $request->id);
                $vistoria->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $request->id],
                        ['slug_padrao_energia' => $disjuntor,]
                    );
            }
        }

        // Telhado
        if ($request->hasFile('telhado')) {
            if ($request->file('telhado')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $disjuntor = $request->telhado->store('orcamentos/vistoria/' . $request->id);
                $vistoria->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $request->id],
                        ['slug_telhado' => $disjuntor,]
                    );
            }
        }

        // Fiacao
        if ($request->hasFile('fiacao')) {
            if ($request->file('fiacao')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $disjuntor = $request->fiacao->store('orcamentos/vistoria/' . $request->id);
                $vistoria->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $request->id],
                        ['slug_fiacao' => $disjuntor,]
                    );
            }
        }

        // Medidor
        if ($request->hasFile('medidor')) {
            if ($request->file('medidor')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $disjuntor = $request->medidor->store('orcamentos/vistoria/' . $request->id);
                $vistoria->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $request->id],
                        ['slug_medidor' => $disjuntor,]
                    );
            }
        }

        if ($request->hasFile('outros')) {
            if ($request->file('outros')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $disjuntor = $request->outros->store('orcamentos/vistoria/' . $request->id);
                $vistoria->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $request->id],
                        ['slug_outros' => $disjuntor,]
                    );
            }
        }

        $vistoria->newQuery()
            ->updateOrInsert(
                ['orcamentos_id' => $request->id], [
                    'observacoes' => $request->observacoes,
                ]
            );

        return redirect()->back();
    }
}
