<?php

namespace App\Http\Controllers\Vendedor\Perfil;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SenhaController extends Controller
{
    public function edit($id)
    {
        if ($id != id_usuario_atual()) return redirect('home');

        $user = new User();
        $usuario = $user->newQuery()
            ->find($id);

        return view('pages.vendedor.perfil.senha.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        if ($id != id_usuario_atual()) return redirect('home');

        $user = new User();
        $dados = $user->newQuery()
            ->findOrFail($id);

        if (password_verify($request->senha_atual, $dados->password)) {
            if ($request->nova_senha == $request->repetir_senha) {
                $dados->update([
                    'password' => Hash::make($request->nova_senha)
                ]);
                modalSucesso('Senha alterada com sucesso!');
            } else modalErro('Nova senha e confirmação da nova senha não estão iguais.');
        } else modalErro('A senha atual está inválida.');

        return redirect()->back();
    }
}
