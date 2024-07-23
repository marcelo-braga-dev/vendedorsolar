<?php

namespace App\Http\Controllers\Admin\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = (new User())->admins();

        return view('pages.admin.usuarios.admins.index', compact('usuarios'));
    }

    public function create()
    {
        return view('pages.admin.usuarios.admins.create');
    }

    public function store(Request $request)
    {
        $user = new User();

        (new User())->newQuery()
            ->create([
                'name' => $request->name,
                'email' => strtolower($request->email),
                'password' => Hash::make($request->email),
                'tipo' => 'admin'
            ]);

        return redirect()->route('admin.usuarios.admins.index');
    }

    public function show($id)
    {
        $user = new User();
        $usuario = $user->newQuery()->findOrFail($id);
        $dados = $user->metas($id);

        return view('pages.admin.usuarios.admins.show', compact('usuario', 'dados'));
    }

    public function edit($id)
    {
        $user = new User();
        $usuario = $user->newQuery()->find($id);

        $metas = new UserMeta();
        $dados = $metas->metas($id);

        return view('pages.admin.usuarios.admins.edit', compact('usuario', 'dados'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = new User();
            $user->atualizar($request, $id);

            modalSucesso('Dados atualizado com sucesso!');
        } catch (\DomainException $e) {
            modalErro($e->getMessage());
        }

        return redirect()->back();
    }
}
