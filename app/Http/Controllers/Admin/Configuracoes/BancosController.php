<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Bancos;
use Illuminate\Http\Request;

class BancosController extends Controller
{
    public function index()
    {
        $bancos = (new Bancos())->newQuery()
            ->orderBy('nome')
            ->orderBy('qtd_parcelas')
            ->get();

        return view('pages.admin.configs.bancos.index', compact('bancos'));
    }

    public function create()
    {
        return view('pages.admin.configs.bancos.create');
    }

    public function edit($id)
    {
        $bancos = new Bancos();
        $banco = $bancos->newQuery()->findOrFail($id);

        return view('pages.admin.configs.bancos.edit', compact('banco'));
    }

    public function store(Request $request)
    {
        $bancos = new Bancos();
        $bancos->newQuery()
            ->create([
                'nome' => $request->nome,
                'juros_mensal' => $request->juros_mensal,
                'qtd_parcelas' => $request->qtd_parcelas,
                'carencia' => $request->carencia,
                'status' => 1,
                'img_logo' => $this->uploadImagem($request, $bancos)
            ]);

        modalSucesso('Banco cadastrado com sucesso.');

        return redirect()->route('admin.configs.bancos.index');
    }

    private function uploadImagem(Request $request, $painel)
    {
        if ($request->hasFile('img_logo')) {
            if ($request->file('img_logo')->isValid()) {
                deleteFileStorage($painel->img_logo);

                return $request->img_logo->store('bancos');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $bancos = new Bancos();
        $banco = $bancos->newQuery()
            ->findOrFail($id);

        $banco->update([
                'nome' => $request->nome,
                'juros_mensal' => $request->juros_mensal,
                'qtd_parcelas' => $request->qtd_parcelas,
                'carencia' => $request->carencia,
                'status' => $request->status,
                'img_logo' => $this->uploadImagem($request, $banco) ?? $banco->img_logo
            ]);

        modalSucesso('Informações atualizadas com sucesso.');

        return redirect()->route('admin.configs.bancos.index');
    }

    public function destroy($id)
    {
        $bancos = new Bancos();
        $bancos->newQuery()
            ->findOrFail($id)
            ->delete();

        modalSucesso('Banco deletado com sucesso.');

        return redirect()->route('admin.configs.bancos.index');
    }
}
