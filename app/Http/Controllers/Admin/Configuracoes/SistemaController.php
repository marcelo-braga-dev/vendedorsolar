<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;
use App\Models\Configs;
use App\Services\Sistema\LogoService;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    public function index()
    {
        $kitLimiteDiasAtualizacao = getKitLimiteDiasAtualizacao();

        return view('pages.admin.configs.sistema.index', compact('kitLimiteDiasAtualizacao'));
    }

    public function store(Request $request)
    {
        if ($request->logo) {
            (new LogoService())->update($request);
        }

        if ($request->kit_limite_dias_atualizacao !== null) {
            Configs::query()->updateOrCreate(
                ['meta_key' => 'kit_limite_dias_atualizacao'],
                ['value' => $request->kit_limite_dias_atualizacao]
            );
        }

        modalSucesso('Atualizações realizadas com sucesso!');
        return redirect()->back();
    }
}
