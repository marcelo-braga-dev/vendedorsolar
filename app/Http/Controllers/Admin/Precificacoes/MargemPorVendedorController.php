<?php

namespace App\Http\Controllers\Admin\Precificacoes;

use App\Models\MargemVendaPorVendedor;
use App\Models\User;
use Illuminate\Http\Request;

class MargemPorVendedorController
{
    public function index()
    {
        $user = new User();
        $vendedores = $user->vendedores();

        $margemVendedor = new MargemVendaPorVendedor();
        $margens = $margemVendedor->newQuery()
            ->get();

        return view('pages.admin.precificacao.margem-vendedor.index', compact('vendedores', 'margens'));
    }

    public function store(Request $request)
    {
        $margemVendedor = new MargemVendaPorVendedor();
        $margemVendedor->newQuery()
            ->updateOrInsert(
                ['users_id' => $request->vendedor],
                ['margem' => $request->margem, 'updated_at' => now()]
            );
        modalSucesso('Margem atualizada com sucesso!');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $margem = new MargemVendaPorVendedor();
        $margem->newQuery()
            ->findOrFail($id)
            ->delete();

        modalSucesso('Margem deletada com sucesso!');
        return redirect()->back();
    }
}
