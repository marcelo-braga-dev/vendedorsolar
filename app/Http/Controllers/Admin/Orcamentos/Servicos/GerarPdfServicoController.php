<?php

namespace App\Http\Controllers\Admin\Orcamentos\Servicos;

use App\Http\Controllers\Controller;
//use App\src\PDF\Solmar\Servicos\GerarPdfServicos;
use App\src\PDF\Ecovolt\Servicos\GerarPdfServicos;
use Illuminate\Http\Request;

class GerarPdfServicoController extends Controller
{
    public function __invoke(Request $request)
    {
        return (new GerarPdfServicos())->gerar($request->id);
    }
}
