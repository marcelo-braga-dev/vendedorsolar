<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Models\IntegracaoAldo;
use Illuminate\Http\Request;

class ChavesController
{
    public function update(Request $request)
    {
        (new IntegracaoAldo())->newQuery()
            ->updateOrCreate(
                ['categoria' => 'chaves_integracao', 'aldo' => 'chave'],
                ['id_referencia' => $request->chave_integracao]
            );
        (new IntegracaoAldo())->newQuery()
            ->updateOrCreate(
                ['categoria' => 'chaves_integracao', 'aldo' => 'codigo'],
                ['id_referencia' => $request->codigo_integracao]
            );

        modalSucesso('Dados atualizados com sucesso!');
        return redirect()->back();
    }
}
