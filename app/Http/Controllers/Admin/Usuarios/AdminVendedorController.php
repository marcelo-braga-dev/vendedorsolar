<?php

namespace App\Http\Controllers\Admin\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMeta;
use App\src\Usuarios\AdminVendedor;
use Illuminate\Http\Request;

class AdminVendedorController extends Controller
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new AdminVendedor();
    }

    public function index()
    {
        $usuarios = (new User())->adminVendedores();

        return view('pages.admin.usuarios.admin-vendedor.index', compact('usuarios'));
    }

    public function create()
    {
        return view('pages.admin.usuarios.admin-vendedor.create');
    }

    public function store(Request $request)
    {
        try {
            $usuario = (new User())->cadastrar($request->name, $request->email, $this->usuario->getChave(), $request->status);

            $this->setMetaDados($request);
            $this->usuario->metas($usuario->id);
            $this->usuario->comissao($usuario->id);

            modalSucesso('Vendedor cadastrado com sucesso!');
        } catch (\DomainException $e) {
            modalErro($e->getMessage());
            return redirect()->route('admin.usuarios.admins-vendedores.create');
        }

        return redirect()->route('admin.usuarios.admins-vendedores.index');
    }

    private function setMetaDados(Request $request): void
    {
        $this->usuario->cpf = $request->cpf;
        $this->usuario->cnpj = $request->cnpj;
        $this->usuario->rg = $request->rg;
        $this->usuario->celular = $request->celular;
        $this->usuario->taxa_comissao = $request->taxa_comissao;
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
            $this->usuario->metas($id);
            $this->usuario->comissao($id);

            modalSucesso('Dados atualizado com sucesso!');
        } catch (\DomainException $e) {
            modalErro($e->getMessage());
        }

        return redirect()->back();
    }
}
