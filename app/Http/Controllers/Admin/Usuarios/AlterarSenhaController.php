<?php

namespace App\Http\Controllers\Admin\Usuarios;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AlterarSenhaController
{
    public function edit($id)
    {
        $usuario = (new User())->newQuery()->findOrFail($id);
        return view('pages.admin.usuarios.alterar-senha.edit', compact('usuario'));
    }

    public function update($id, Request $request)
    {
            (new User())->newQuery()->findOrFail($id)
                ->update([
                    'password' => Hash::make('1234')
                ]);
        modalSucesso('Senha resetada!');
        return redirect()->route('admin.usuarios.vendedores.show', $id);
    }
}
