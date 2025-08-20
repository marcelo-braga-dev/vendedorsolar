<?php

namespace App\Http\Controllers\Admin\Orcamentos\Servicos;

use App\Http\Controllers\Controller;
use App\Repositories\Propostas\Servicos\ServicosRepository;
use Illuminate\Http\Request;

class ServicosController extends Controller
{
    public function index()
    {
        $propostas = (new ServicosRepository)->all();

        return view('pages.admin.orcamentos.servicos.index', compact('propostas'));
    }

    public function show($id)
    {
        $proposta = (new ServicosRepository)->find($id);
//print_pre($proposta);
        return view('pages.admin.orcamentos.servicos.show', compact('proposta'));
    }
}
