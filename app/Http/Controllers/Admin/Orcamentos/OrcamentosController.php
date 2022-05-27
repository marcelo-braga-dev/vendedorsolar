<?php

namespace App\Http\Controllers\Admin\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\OrcamentosMetas;
use App\Models\Produtos;
use App\Models\User;
use App\Models\UserMeta;
use App\src\Orcamentos\Status\Aprovado;
use App\src\Orcamentos\Status\Assinado;
use App\src\Orcamentos\Status\Finalizado;
use App\src\Orcamentos\Status\Instalando;
use App\src\Orcamentos\Status\Novo;
use App\src\Orcamentos\Status\StatusOrcamentos;
use Illuminate\Http\Request;

class OrcamentosController extends Controller
{
    public function index(Request $request)
    {
        $cliente = [];
        $vendedor = [];

        $where = $this->getStatus($request->status);

        $orcamentos = (new Orcamentos())->newQuery()
            ->where($where)
            ->orderBy('id', 'DESC')
            ->paginate();

        $clientes = (new Clientes())->newQuery()->get(['id', 'nome']);

        foreach ($clientes as $item) {
            $cliente[$item->id] = $item->nome;
        }

        $usuarios = (new User())->newQuery()->get(['id', 'name']);

        foreach ($usuarios as $item) {
            $vendedor[$item->id] = $item->name;
        }

        return view('pages.admin.orcamentos.index', compact('orcamentos', 'cliente', 'vendedor'));
    }

    private function getStatus(?string $status)
    {
        switch ($status) {
            case 'novos' : $tag = (new Novo())->getStatus(); break;
            case 'assinados' : $tag = (new Assinado())->getStatus(); break;
            case 'aprovados' : $tag = (new Aprovado())->getStatus(); break;
            case 'instalandos' : $tag = (new Instalando())->getStatus(); break;
            case 'finalizados' : $tag = (new Finalizado())->getStatus(); break;
            default : return null;
        }

        return [['status', '=', $tag]];
    }

    public function show(int $id)
    {
        $orcamentos = new Orcamentos;
        $orcamento = $orcamentos->newQuery()
            ->findOrFail($id);

        $kits = new Kits();
        $kit = $kits->newQuery()
            ->find($orcamento->kits_id);

        $meta = new ClientesMetas();
        $dadosCliente = $meta->values($orcamento->clientes_id);

        $produtos = new Produtos();
        $imagens = $produtos->getImagensNome();

        $userMeta = new UserMeta();
        $dadosVendedor = $userMeta->metas($orcamento->users_id);

        $metas = (new OrcamentosMetas())->getMetas($orcamento->id);

        return view('pages.admin.orcamentos.show',
            compact('orcamento', 'kit', 'imagens', 'dadosCliente', 'dadosVendedor', 'metas'));
    }

    public function update(Request $request, int $id)
    {
        $orcamentos = new Orcamentos;
        $orcamentos->newQuery()
            ->find($id)
            ->update([
                'preco_cliente' => convert_money_float($request->preco_cliente),
                'geracao' => $request->geracao,
                'status' => $request->status,
                'anotacoes' => $request->anotacoes
            ]);

        modalSucesso('Informações atualizadas com sucesso.');

        return redirect()->route('admin.orcamentos.update', $id);
    }

    public function edit($id)
    {
        $orcamentos = new Orcamentos;
        $orcamento = $orcamentos->newQuery()
            ->findOrFail($id);

        $statusOrcamentos = new StatusOrcamentos();
        $todosStatus = $statusOrcamentos->todosStatus();

        return view('pages.admin.orcamentos.edit', compact('orcamento', 'todosStatus'));
    }
}
