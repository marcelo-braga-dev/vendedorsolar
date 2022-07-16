<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use App\Services\Sistema\LogoService;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    public function index()
    {
        return view('pages.admin.configs.sistema.index');
    }

    public function store(Request $request)
    {
        if ($request->logo) {
            (new LogoService())->update($request);
        }

        modalSucesso('Atualizações realizadas com sucesso!');
        return redirect()->back();
    }
}
