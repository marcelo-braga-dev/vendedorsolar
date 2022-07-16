<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CidadesEstados;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function getIdCidadeEstado(Request $request)
    {
        return (new CidadesEstados())->dados($request->id);
    }
}
