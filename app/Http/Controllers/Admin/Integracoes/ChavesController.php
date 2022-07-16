<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Controller;
use App\Models\IntegracaoAldo;
use Illuminate\Http\Request;

class ChavesController extends Controller
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
