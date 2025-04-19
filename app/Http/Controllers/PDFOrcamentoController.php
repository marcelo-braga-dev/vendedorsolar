<?php

namespace App\Http\Controllers;

use App\src\PDF\GerarPDF;
use Illuminate\Http\Request;

class PDFOrcamentoController extends Controller
{
    public function index(Request $request)
    {
        return (new GerarPDF())->gerar($request);
    }
}
