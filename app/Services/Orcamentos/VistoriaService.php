<?php

namespace App\Services\Orcamentos;

use App\Models\OrcamentosVistorias;

class VistoriaService
{
    public function imagens($request)
    {
        $vistoria = (new OrcamentosVistorias())->newQuery();
        $url = $vistoria->where('orcamentos_id', $request->id)->first();

        $this->armazenar($request, $url, $vistoria, 'disjuntor', 'slug_disjuntor');
        $this->armazenar($request, $url, $vistoria, 'padrao_energia', 'slug_padrao_energia');
        $this->armazenar($request, $url, $vistoria, 'telhado', 'slug_telhado');
        $this->armazenar($request, $url, $vistoria, 'fiacao', 'slug_fiacao');
        $this->armazenar($request, $url, $vistoria, 'medidor', 'slug_medidor');
        $this->armazenar($request, $url, $vistoria, 'outros', 'slug_outros');
        $this->armazenar($request, $url, $vistoria, 'arquivo_1', 'slug_arquivo_1');
        $this->armazenar($request, $url, $vistoria, 'arquivo_2', 'slug_arquivo_2');
        $this->armazenar($request, $url, $vistoria, 'arquivo_3', 'slug_arquivo_3');

        $vistoria->updateOrInsert(
            ['orcamentos_id' => $request->id], [
                'observacoes' => $request->observacoes,
            ]
        );
    }

    private function armazenar($request, $url, $vistoria, $file, $chave)
    {
        if ($request->hasFile($file)) {
            if ($request->file($file)->isValid()) {
                deleteFileStorage($url->$chave ?? '');

                $disjuntor = $request->$file->store('orcamentos/vistoria/' . $request->id);
                $vistoria->updateOrInsert(
                    ['orcamentos_id' => $request->id],
                    [$chave => $disjuntor]
                );
            }
        }
    }
}
