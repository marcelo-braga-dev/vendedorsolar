<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Concessionarias;
use Illuminate\Http\Request;

class ConcessionariasController extends Controller
{
    public function index()
    {
        $items = (new Concessionarias())->newQuery()
            ->orderBy('estado')
            ->paginate(20);

        return view('pages.admin.configs.concessionarias.index', compact('items'));
    }

    public function edit($id)
    {
        $item = (new Concessionarias())->newQuery()
            ->findOrFail($id);

        return view('pages.admin.configs.concessionarias.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        (new Concessionarias())->newQuery()
            ->where('id', '=', $id)
            ->update([
                'ponta' => $request->ponta,
                'fora_ponta' => $request->fora_ponta
            ]);
        modalSucesso('Dados atualizados com sucesso!');

        return redirect()->back();
    }
}
