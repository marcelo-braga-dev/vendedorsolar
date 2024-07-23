<?php

namespace App\Http\Controllers\Admin\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use App\src\Usuarios\Vendedores;
use Illuminate\Http\Request;

class VendedoresController extends Controller
{
    private $tipo;
    private $vendedor;

    public function __construct()
    {
        $this->tipo = (new Vendedores())->getChave();
        $this->vendedor = new Vendedores();
    }

    public function index()
    {
        $usuarios = (new User())->vendedores();

        return view('pages.admin.usuarios.vendedores.index', compact('usuarios'));
    }

    public function create()
    {
        return view('pages.admin.usuarios.vendedores.create');
    }

    public function store(Request $request)
    {
        try {
            $usuario = (new User())->cadastrar($request->name, $request->email, $this->tipo, $request->status);

            $this->setMetaDados($request);
            $this->vendedor->metas($usuario->id);
            $this->vendedor->comissao($usuario->id);

            modalSucesso('Vendedor cadastrado com sucesso!');
        } catch (\DomainException $e) {
            modalErro('Ocorreu um errro.');
            return redirect()->route('admin.usuarios.vendedores.create');
        }

        return redirect()->route('admin.usuarios.vendedores.index');
    }

    private function setMetaDados(Request $request): void
    {
        $this->vendedor->cpf = $request->cpf;
        $this->vendedor->cnpj = $request->cnpj;
        $this->vendedor->rg = $request->rg;
        $this->vendedor->celular = $request->celular;
        $this->vendedor->taxa_comissao = $request->taxa_comissao;
    }

    public function show($id)
    {
        $user = new User();
        $usuario = $user->newQuery()->findOrFail($id);

        $dados = $user->metas($id);

        return view('pages.admin.usuarios.vendedores.show', compact('usuario', 'dados'));
    }

    public function edit($id)
    {
        $user = new User();
        $usuario = $user->newQuery()
            ->find($id);

        $metas = new UserMeta();
        $dados = $metas->metas($id);
        $comissao = getTaxaComissao($id);

        return view('pages.admin.usuarios.vendedores.edit', compact('usuario', 'dados', 'comissao'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = new User();
            $user->atualizar($request, $id);

            $this->setMetaDados($request);
            $this->vendedor->metas($id);
            $this->vendedor->comissao($id);

            modalSucesso('Dados atualizado com sucesso!');
        } catch (\DomainException $e) {
            modalErro($e->getMessage());
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        //
    }
}
