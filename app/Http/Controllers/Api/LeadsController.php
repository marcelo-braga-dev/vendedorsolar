<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    public function store(Request $request)
    {
        // if ($_SERVER['HTTP_HOST'] !== 'vendedorsolar.dev') return 'Acesso negado!';

        (new Leads())->newQuery()
            ->create([
                'nome' => $request->nome,
                'vendedor' => null,
                'telefone' => $request->telefone,
                'email' => $request->email,
                'cidade' => $request->cidade,
                'estado' => $request->estado,
                'consumo' => $request->consumo,
                'dados' => null,
                'status' => 'novo',
            ]);
        return true;
    }
}
