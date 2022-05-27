<?php

namespace App\Http\Controllers\Vendedor\Perfil;

use App\Models\User;
use Illuminate\Http\Request;

class PerfilController
{
    public function edit($id)
    {
        if ($id != id_usuario_atual()) return redirect('home');

        $user = new User();
        $usuario = $user->newQuery()
            ->find($id);

        return view('pages.vendedor.perfil.dados.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        if ($id != id_usuario_atual()) return redirect('home');

        $user = new User();

        return redirect()->route('vendedor.perfil.edit', id_usuario_atual());
    }
}
