<?php

namespace App\Http\Controllers\Vendedor\Mensagens;

class MensagensController
{
    public function index()
    {
        return view('pages.vendedor.mensagens.conversas.index');
    }
}
