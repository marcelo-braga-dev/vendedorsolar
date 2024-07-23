<?php

namespace App\Http\Controllers\Admin\Integracoes;

use App\Http\Controllers\Controller;
use App\Models\IntegracaoAldo;
use App\Models\Produtos;
use App\src\Integracoes\Aldo\IntegrarAldo;
use App\src\Integracoes\Aldo\Produtos\Infos\ReferenciasAldo;
use Illuminate\Http\Request;

class AldoController extends Controller
{
    public function index()
    {
        $chaves = (new IntegracaoAldo())->chaves();

        return view('pages.admin.integracoes.aldo.index', compact('chaves'));
    }

    public function pesquisar(Request $request)
    {
        try {
            $dados = (new IntegrarAldo())->pesquisar();
        } catch (\DomainException $e) {
            modalErro($e->getMessage());
            return redirect()->route('admin.integracoes.aldo.index');
        }

        $items = (new Produtos())->newQuery()->get(['id', 'nome', 'tipo']);

        $produtos = [];
        foreach ($items as $item) {
            $produtos[$item->tipo][$item->id] = $item->nome;
        }

        return view('pages.admin.integracoes.aldo.pesquisar', compact('dados', 'produtos'));
    }

    public function store(Request $request)
    {
        (new ReferenciasAldo())->update($request);

        return redirect()->route('admin.integracoes.aldo.index');
    }

    public function integrar()
    {
        try {
            (new IntegrarAldo())->integrar();
            return redirect()->route('admin.integracoes.historico.index');
        } catch (\DomainException $e) {
            modalErro($e->getMessage());
            return redirect()->route('admin.integracoes.aldo.index');
        }
    }
}
