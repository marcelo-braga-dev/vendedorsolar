<?php

namespace App\Http\Controllers;

use App\src\PDF\Solmar\GerarPDF;
use Illuminate\Http\Request;

class PDFOrcamentoController extends Controller
{
    public function index(Request $request)
    {
        $modelo = new GerarPDF($request->id, $request->grafico_geracao, $request->grafico_payback);
        $modelo->gerar();
    }
}
