<?php

namespace App\Http\Controllers\Admin\Contratos;

use App\Http\Controllers\Controller;
use App\src\PDF\Solmar\Contratos\GerarPdfContrato;
use Illuminate\Http\Request;

class GerarPdfContratoController extends Controller
{
    public function __invoke(Request $request)
   {
       return (new GerarPdfContrato())->gerar($request->id);
   }
}
