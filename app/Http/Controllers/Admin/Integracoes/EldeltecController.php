<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Admin\Integracoes\Edeltec\EdeltecIntegracao;
use App\Http\Controllers\Controller;
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
        (new EdeltecIntegracao())->init();

        modalSucesso('Integração realizada com sucesso!');
        return redirect()->route('admin.integracoes.eldeltec.index', ['page' => $id]);
    }
}
