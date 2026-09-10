<?php

namespace App\Http\Controllers;

use App\src\PDF\GerarPDF;
use Illuminate\Http\Request;

class PDFOrcamentoController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'grafico_geracao' => ['required', 'string'],
            'grafico_payback' => ['required', 'string'],
        ]);

        return (new GerarPDF())->gerar($request);
    }
}
