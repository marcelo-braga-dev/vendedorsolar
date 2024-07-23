<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Controller;
use App\Models\Fornecedores;
use App\src\Integracoes\Arquivos\Arquivo;
use Illuminate\Http\Request;

class ArquivoController extends Controller
{
    public function index()
    {
        $fornecedores = (new Fornecedores)->newQuery()->orderBy('nome')->get(['id', 'nome']);
        return view('pages.admin.integracoes.arquivo.index', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        try {
            $resposta = (new Arquivo())->executar($request);
            modalSucesso($resposta);
        } catch (\DomainException $exception) {
            modalErro($exception->getMessage());
            return redirect()->back();
        }
        return redirect()->route('admin.integracoes.historico.index');
    }
}
