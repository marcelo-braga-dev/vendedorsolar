<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Http\Controllers\Controller;
use App\Models\Fornecedores;
use App\Models\PrecificacaoMetas;
use App\src\Precificacao\MargemFornecedores;
use Illuminate\Http\Request;

class MargemFornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = (new Fornecedores())->fornecedores();
        $margens = (new PrecificacaoMetas())->getDados((new MargemFornecedores())->getChave());

        return view('pages.admin.precificacao.margem-fornecedores.index',
            compact('fornecedores', 'margens'));
    }

    public function store(Request $request)
    {
        $chave = (new MargemFornecedores())->getChave();
        (new PrecificacaoMetas())->criar($chave, $request->vendedor, $request->margem);

        modalSucesso('Margem atualizada com sucesso!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        (new PrecificacaoMetas())->deletar($id);

        modalSucesso('Margem deletada com sucesso!');
        return redirect()->back();
    }
}
