<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Models\AprovacaoOrcamentos;
use Illuminate\Http\Request;

class AprovacaoController
{
    public function show($id)
    {
        $dados = [];

        $aprovacao = new AprovacaoOrcamentos();
        $valores = $aprovacao->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->get(['meta', 'value']);

        foreach ($valores as $valor) {
            $dados[$valor['meta']] = $valor['value'];
        }

        //print_pre($dados);
        return view('pages.vendedor.orcamentos.aprovacao.show', compact('id', 'dados'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $dados = $request->except(
            ['_token', 'id']
        );

        $aprovacao = new AprovacaoOrcamentos();

        foreach ($dados as $index => $dado) {
            $aprovacao->newQuery()
                ->updateOrInsert(
                    ['orcamentos_id' => $id, 'meta' => $index],
                    ['value' => $dado]
                );
        }

        $this->imagens($request, $id);

        modalSucesso('Dados enviados com sucesso!');
        return redirect()->back();
    }

    private function imagens($request, $id)
    {
        $aprovacao = new AprovacaoOrcamentos();

        if ($request->hasFile('img_cnh_proprietario')) {
            if ($request->file('img_cnh_proprietario')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $slug = $request->img_cnh_proprietario->store('orcamentos/aprovacao/' . $id);
                $aprovacao->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $id, 'meta' => 'img_cnh_proprietario'],
                        ['value' => $slug]
                    );
            }
        }

        if ($request->hasFile('img_cpf_proprietario')) {
            if ($request->file('img_cpf_proprietario')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $slug = $request->img_cpf_proprietario->store('orcamentos/aprovacao/' . $id);
                $aprovacao->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $id, 'meta' => 'img_cpf_proprietario'],
                        ['value' => $slug]
                    );
            }
        }

        if ($request->hasFile('img_rg_proprietario')) {
            if ($request->file('img_rg_proprietario')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $slug = $request->img_rg_proprietario->store('orcamentos/aprovacao/' . $id);
                $aprovacao->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $id, 'meta' => 'img_rg_proprietario'],
                        ['value' => $slug]
                    );
            }
        }

        if ($request->hasFile('img_conta_instalacao')) {
            if ($request->file('img_conta_instalacao')->isValid()) {
                // deleteFileStorage($request->disjuntor);

                $slug = $request->img_conta_instalacao->store('orcamentos/aprovacao/' . $id);
                $aprovacao->newQuery()
                    ->updateOrInsert(
                        ['orcamentos_id' => $id, 'meta' => 'img_conta_instalacao'],
                        ['value' => $slug]
                    );
            }
        }
    }
}
