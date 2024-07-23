<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Http\Controllers\Controller;
use App\Models\PrecificacaoMetas;
use App\Models\User;
use App\src\Precificacao\MargemVendedor;
use Illuminate\Http\Request;

class MargemPorVendedorController extends Controller
{
    public function index()
    {
        $vendedores = (new User())->vendedores();
        $margens = (new PrecificacaoMetas())->getDados((new MargemVendedor())->getChave());

        return view('pages.admin.precificacao.margem-vendedor.index',
            compact('vendedores', 'margens'));
    }

    public function store(Request $request)
    {
        $chave = (new MargemVendedor())->getChave();
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
