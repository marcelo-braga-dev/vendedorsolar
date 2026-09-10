<?php

namespace App\Http\Controllers\Admin\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\TaxaComissoes;
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

    public function index(Request $request)
    {
        $where = [['tipo', '=', $this->tipo]];
        if ($request->filled('nome')) {
            $where[] = ['name', 'like', '%'.$request->nome.'%'];
        }
        if ($request->filled('email')) {
            $where[] = ['email', 'like', '%'.$request->email.'%'];
        }
        if ($request->status !== null && $request->status !== '') {
            $where[] = ['status', '=', $request->status];
        }

        $usuarios = (new User())->newQuery()
            ->where($where)
            ->orderBy('id', 'DESC')
            ->paginate(20)
            ->withQueryString();

        $ids = $usuarios->pluck('id');

        $celulares = UserMeta::query()
            ->whereIn('users_id', $ids)
            ->where('meta', 'celular')
            ->pluck('value', 'users_id');

        $comissoes = TaxaComissoes::query()
            ->whereIn('user_id', $ids)
            ->pluck('taxa', 'user_id');

        $clientesCount = Clientes::query()
            ->whereIn('users_id', $ids)
            ->selectRaw('users_id, count(*) as total')
            ->groupBy('users_id')
            ->pluck('total', 'users_id');

        return view('pages.admin.usuarios.vendedores.index',
            compact('usuarios', 'request', 'celulares', 'comissoes', 'clientesCount'));
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
