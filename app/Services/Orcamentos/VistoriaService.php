<?php

namespace App\Services\Orcamentos;

use App\Models\VistoriaOrcamentos;

class VistoriaService
{
    public function imagens($request)
    {
        $vistoria = (new VistoriaOrcamentos())->newQuery();
        $url = $vistoria->where('orcamentos_id', $request->id)->first();

        // Disjuntor
        if ($request->hasFile('disjuntor')) {
            if ($request->file('disjuntor')->isValid()) {
                deleteFileStorage($url->slug_disjuntor ?? '');

                $disjuntor = $request->disjuntor->store('orcamentos/vistoria/' . $request->id);
                $vistoria->updateOrInsert(
                    ['orcamentos_id' => $request->id],
                    ['slug_disjuntor' => $disjuntor,]
                );
            }
        }

        // Padrao
        if ($request->hasFile('padrao_energia')) {
            if ($request->file('padrao_energia')->isValid()) {
                deleteFileStorage($url->slug_padrao_energia ?? '');

                $disjuntor = $request->padrao_energia->store('orcamentos/vistoria/' . $request->id);
                $vistoria->updateOrInsert(
                    ['orcamentos_id' => $request->id],
                    ['slug_padrao_energia' => $disjuntor,]
                );
            }
        }

        // Telhado
        if ($request->hasFile('telhado')) {
            if ($request->file('telhado')->isValid()) {
                deleteFileStorage($url->slug_telhado ?? '');

                $disjuntor = $request->telhado->store('orcamentos/vistoria/' . $request->id);
                $vistoria->updateOrInsert(
                    ['orcamentos_id' => $request->id],
                    ['slug_telhado' => $disjuntor,]
                );
            }
        }

        // Fiacao
        if ($request->hasFile('fiacao')) {
            if ($request->file('fiacao')->isValid()) {
                deleteFileStorage($url->slug_fiacao ?? '');

                $disjuntor = $request->fiacao->store('orcamentos/vistoria/' . $request->id);
                $vistoria->updateOrInsert(
                    ['orcamentos_id' => $request->id],
                    ['slug_fiacao' => $disjuntor,]
                );
            }
        }

        // Medidor
        if ($request->hasFile('medidor')) {
            if ($request->file('medidor')->isValid()) {
                deleteFileStorage($url->slug_medidor ?? '');

                $disjuntor = $request->medidor->store('orcamentos/vistoria/' . $request->id);
                $vistoria->updateOrInsert(
                    ['orcamentos_id' => $request->id],
                    ['slug_medidor' => $disjuntor,]
                );
            }
        }

        if ($request->hasFile('outros')) {
            if ($request->file('outros')->isValid()) {
                deleteFileStorage($url->slug_outros ?? '');

                $disjuntor = $request->outros->store('orcamentos/vistoria/' . $request->id);
                $vistoria->updateOrInsert(
                    ['orcamentos_id' => $request->id],
                    ['slug_outros' => $disjuntor,]
                );
            }
        }

        $vistoria->updateOrInsert(
            ['orcamentos_id' => $request->id], [
                'observacoes' => $request->observacoes,
            ]
        );
    }
}
