<?php

namespace App\Http\Controllers\Vendedor\Mensagens;

use App\Http\Controllers\Controller;

class MensagensController extends Controller
{
    public function index()
    {
        return view('pages.vendedor.mensagens.conversas.index');
    }
}
