<?php

namespace App\Http\Controllers\Api;

use App\Models\CidadesEstados;
use Illuminate\Http\Request;

class EnderecoController
{
    public function getIdCidadeEstado(Request $request)
    {
        $cidadesEstados = new CidadesEstados();
        return $cidadesEstados->dados($request->id);
    }
}
