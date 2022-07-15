<?php

namespace App\Http\Controllers\Api;

use App\Models\CidadesEstados;
use Illuminate\Http\Request;

class EnderecoController
{
    public function getIdCidadeEstado(Request $request)
    {
        return (new CidadesEstados())->dados($request->id);
    }
}
