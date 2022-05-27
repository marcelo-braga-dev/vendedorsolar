<?php

namespace App\Http\Controllers;

use App\src\PDF\BahiaSolar\BahiaSolarPDF;
use App\src\PDF\Solmar\Modelo_1;
use Illuminate\Http\Request;

class PDFOrcamentoController extends Controller
{
    public function index(Request $request)
    {
        //$modelo = new Modelo_1($request->id, $request->grafico_geracao, $request->grafico_payback);
        $modelo = new BahiaSolarPDF($request->id, $request->grafico_geracao, $request->grafico_payback);
        $modelo->gerar();
    }
}
