<?php

namespace App\Http\Controllers\Admin\Produtos;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormCadastroKitRequest;
use App\Models\Estruturas;
use App\Models\Fornecedores;
use App\Models\Kits;
use App\Models\Produtos;
use App\src\Produtos\CadastrarKit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class KitsController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        if ($request->estrutura) $where[] = ['estrutura', '=', $request->estrutura];
        if ($request->fornecedor) $where[] = ['fornecedor', '=', $request->fornecedor];
        if ($request->inversor) $where[] = ['marca_inversor', '=', $request->inversor];
        if ($request->painel) $where[] = ['marca_painel', '=', $request->painel];
        if ($request->status) $where[] = ['status', '=', $request->status - 1];
        if ($request->status_fornecedor) $where[] = ['status_fornecedor', '=', $request->status_fornecedor - 1];
        if ($request->codigo) $where = [['sku', '=', $request->codigo]];
        if ($request->id) $where = [['id', '=', $request->id]];

        $kits = (new Kits())->newQuery()
            ->where($where)
            ->orderby('id', 'DESC')
            ->paginate(50)
            ->withQueryString();

        $fornecedores = (new Fornecedores())->fornecedores();

        $produtos = new Produtos();
        $inversores = $produtos->inversores();
        $paineis = $produtos->paineis();
        $imgs = $produtos->getDados();

        return view('pages.admin.produtos.kits.index',
            compact('kits', 'fornecedores', 'request', 'inversores', 'paineis', 'imgs'));
    }

    public function create()
    {
        $fornecedores = (new Fornecedores())->newQuery()
            ->orderBy('nome', 'ASC')->get(['id', 'nome']);

        $inversores = (new Produtos())->inversores();
        $paineis = (new Produtos())->paineis();

        return view(
            'pages.admin.produtos.kits.create',
            compact('fornecedores', 'inversores', 'paineis')
        );
    }

    public function store(FormCadastroKitRequest $request)
    {
        try {
            (new CadastrarKit($request))->cadastrar();
            modalSucesso('Cadastro do Kit realizado com sucesso.');
        } catch (\DomainException $exception) {
            modalErro($exception->getMessage());
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $kit = (new Kits())->newQuery()->findOrFail($id);
        $fornecedores = (new Fornecedores())->newQuery()
            ->orderBy('nome', 'ASC')->get(['id', 'nome']);

        $inversores = (new Produtos())->inversores();
        $paineis = (new Produtos())->paineis();

        return view(
            'pages.admin.produtos.kits.edit',
            compact('kit', 'fornecedores', 'inversores', 'paineis')
        );
    }

    public function update($id, FormCadastroKitRequest $request)
    {
        try {
            (new CadastrarKit($request))->atualizar($id);
            modalSucesso('Informações atualizadas com sucesso!.');
        } catch (\DomainException $exception) {
            modalErro($exception->getMessage());
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            (new Kits())->newQuery()->findOrFail($id)->delete();
        } catch (QueryException $exception) {
            modalErro('Não é possível excluir esse kit pois está sendo usado em algum orçamento.');
            return redirect()->back();
        }

        modalSucesso('Kit deletado com sucesso!');
        return redirect()->route('admin.produtos.kits.index');
    }
}
