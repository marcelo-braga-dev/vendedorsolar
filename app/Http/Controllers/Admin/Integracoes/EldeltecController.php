<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Controller;
use App\Services\IntegracoesDistribuidoras\Edeltec\Integracoes;
use App\Services\IntegracoesDistribuidoras\Edeltec\Requisicao;

class EldeltecController extends Controller
{
    public function index()
    {
        return view('pages.admin.integracoes.eldeltec.index');
    }

    public function edit()
    {
        $token = (new Integracoes())->autenticar();
        (new Requisicao())->get($token);
    }
}
