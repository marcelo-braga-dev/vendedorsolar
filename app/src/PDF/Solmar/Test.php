<?php

namespace App\src\PDF\Solmar;

use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;

class Test
{
    public function index()
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('pages.pdf.modelo_1.sessoes.graficos'));

        return $pdf->stream();
        return view('pages.pdf.modelo_1.sessoes.graficos');
    }
}
