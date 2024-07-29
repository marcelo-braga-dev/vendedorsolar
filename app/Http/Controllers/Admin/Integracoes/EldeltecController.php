<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Controller;
use App\Services\IntegracoesDistribuidoras\Edeltec\Integracoes;
use App\Services\IntegracoesDistribuidoras\Edeltec\Requisicao;
use Illuminate\Http\Request;

class EldeltecController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page ?? 1;

        return view('pages.admin.integracoes.eldeltec.index', compact('page'));
    }

    public function edit($id, Request $request)
    {
        $pagina = $id ?? 1;
        $token = (new Integracoes())->autenticar();

        (new Requisicao())->get($token, $pagina);
        modalSucesso('Integração realizada com sucesso!');
        return redirect()->route('admin.integracoes.eldeltec.index', ['page' => $id]);
    }
}
