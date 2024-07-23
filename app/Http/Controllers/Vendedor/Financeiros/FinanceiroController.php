<?php

namespace App\Http\Controllers\Vendedor\Financeiros;

use App\Http\Controllers\Controller;
use App\Models\Orcamentos;

class FinanceiroController extends Controller
{
    public function index()
    {
        $orcamentos = (new Orcamentos())->newQuery()
            ->where('users_id', '=', id_usuario_atual())
            ->orderBy('id', 'DESC')
            ->get();

        $faturamentoTotal = 0;
        foreach ($orcamentos as $item) {
            $faturamentoTotal += $item->preco_cliente;
        }

        return view('pages.vendedor.financeiro.faturamento.index',
            compact('orcamentos', 'faturamentoTotal'));
    }
}
