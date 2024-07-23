<?php

namespace App\Services\Orcamentos;

use App\Models\OrcamentosAprovacoes;

class DadosAprovacaoService
{
    public function imagens($request, $id)
    {
        $aprovacao = (new OrcamentosAprovacoes())->newQuery();
        $url = $aprovacao->where('orcamentos_id', $request->id)->first();

        if ($request->hasFile('img_cnh_proprietario')) {
            if ($request->file('img_cnh_proprietario')->isValid()) {
                // deleteFileStorage($url->);

                $slug = $request->img_cnh_proprietario->store('orcamentos/aprovacao/' . $id);
                $aprovacao->updateOrInsert(
                        ['orcamentos_id' => $id, 'meta' => 'img_cnh_proprietario'],
                        ['value' => $slug]
                    );
            }
        }

        if ($request->hasFile('img_cpf_proprietario')) {
            if ($request->file('img_cpf_proprietario')->isValid()) {
                // deleteFileStorage($url->);

                $slug = $request->img_cpf_proprietario->store('orcamentos/aprovacao/' . $id);
                $aprovacao->updateOrInsert(
                        ['orcamentos_id' => $id, 'meta' => 'img_cpf_proprietario'],
                        ['value' => $slug]
                    );
            }
        }

        if ($request->hasFile('img_rg_proprietario')) {
            if ($request->file('img_rg_proprietario')->isValid()) {
                // deleteFileStorage($url->);

                $slug = $request->img_rg_proprietario->store('orcamentos/aprovacao/' . $id);
                $aprovacao->updateOrInsert(
                        ['orcamentos_id' => $id, 'meta' => 'img_rg_proprietario'],
                        ['value' => $slug]
                    );
            }
        }

        if ($request->hasFile('img_conta_instalacao')) {
            if ($request->file('img_conta_instalacao')->isValid()) {
                // deleteFileStorage($url->);

                $slug = $request->img_conta_instalacao->store('orcamentos/aprovacao/' . $id);
                $aprovacao->updateOrInsert(
                        ['orcamentos_id' => $id, 'meta' => 'img_conta_instalacao'],
                        ['value' => $slug]
                    );
            }
        }
    }
}
