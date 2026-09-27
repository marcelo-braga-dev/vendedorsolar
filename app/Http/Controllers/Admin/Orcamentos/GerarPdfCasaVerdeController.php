<?php

namespace App\Http\Controllers\Admin\Orcamentos;

use App\Http\Controllers\Controller;
use App\src\PDF\CasaVerde\Construtor;
use Illuminate\Http\Request;

class GerarPdfCasaVerdeController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'id' => ['required', 'integer', 'exists:orcamentos,id'],
        ]);

        $gerar = new Construtor($request->id);

        return $gerar->gerar();
    }
}
