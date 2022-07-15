<?php

namespace App\Http\Controllers\Api;

use App\Models\Leads;
use Illuminate\Http\Request;

class LeadsController
{
    public function store(Request $request)
    {
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
