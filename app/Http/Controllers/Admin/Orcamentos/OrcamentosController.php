<?php

namespace App\Http\Controllers\Admin\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\ClientesMetas;
use App\Models\Kits;
use App\Models\OrcamentosKits;
use App\Models\Orcamentos;
use App\Models\OrcamentosInfos;
use App\Models\OrcamentosMetas;
use App\Models\Produtos;
use App\Models\Trafos;
use App\Models\User;
use App\Models\UserMeta;
use App\Services\Orcamentos\ComissaoVendedorService;
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
        $where = $this->getStatus($request->status);
        $orcamentos = (new Orcamentos())->newQuery()
            ->where($where)
            ->orderBy('created_at', 'DESC')
            ->get();

        $clientes = (new Clientes())->newQuery()->get(['id', 'nome']);

        $cliente = [];
        foreach ($clientes as $item) {
            $cliente[$item->id] = $item->nome;
        }

        $usuarios = (new User())->newQuery()->get(['id', 'name']);

        $vendedor = [];
        foreach ($usuarios as $item) {
            $vendedor[$item->id] = $item->name;
        }

        $label = $this->getLabel($request->status);

        return view('pages.admin.orcamentos.index',
            compact('orcamentos', 'cliente', 'vendedor', 'label'));
    }

    private function getStatus(?string $status)
    {
        switch ($status) {
            case 'novos' :
                return [['status', (new Novo())->getStatus()]];
            case 'assinados' :
                return [['status', (new Assinado())->getStatus()]];
            case 'aprovados' :
                return [['status', (new Aprovado())->getStatus()]];
            case 'instalandos' :
                return [['status', (new Instalando())->getStatus()]];
            case 'finalizados' :
                return [['status', (new Finalizado())->getStatus()]];
            default :
                return null;
        }
    }

    private function getLabel(?string $status)
    {
        switch ($status) {
            case 'novos' :
                return 'Orçamentos Novos';
            case 'assinados' :
                return 'Orçamentos Assinados';
            case 'aprovados' :
                return 'Orçamentos Aprovados';
            case 'instalandos' :
                return 'Sistemas Instalados';
            case 'finalizados' :
                return 'Sistemas Finalizados';
            default :
                return 'Todos Orçamentos Gerados';
        }
    }

    public function show(int $id)
    {
        $orcamento = (new Orcamentos)->newQuery()->findOrFail($id);
        $trafo = (new Trafos())->newQuery()->find($orcamento->trafo);
        $dadosCliente = (new ClientesMetas())->values($orcamento->clientes_id);
        $imagens = (new Produtos())->getDados();
        $dadosVendedor = (new UserMeta())->metas($orcamento->users_id);
        $metas = (new OrcamentosInfos())->dado($orcamento->id);
        $orcamentoKit = (new OrcamentosKits())->dado($orcamento->id);
        $kit = (new Kits())->newQuery()->find($orcamentoKit->kits_id);
        $comissao = (new ComissaoVendedorService())->calcular($trafo, $orcamento, $kit, $orcamentoKit);

        return view('pages.admin.orcamentos.show',
            compact('orcamento', 'kit', 'imagens',
                'dadosCliente', 'dadosVendedor', 'metas', 'orcamentoKit', 'comissao', 'trafo'));
    }

    public function update(Request $request, int $id)
    {
        (new Orcamentos)->newQuery()
            ->find($id)
            ->update([
                'preco_cliente' => convert_money_float($request->preco_cliente),
                'geracao' => $request->geracao,
                'anotacoes' => $request->anotacoes
            ]);

        (new OrcamentosKits())->newQuery()
            ->where('orcamentos_id', $id)
            ->update([
                'produtos' => $request->produtos
            ]);

        modalSucesso('Informações atualizadas com sucesso.');

        return redirect()->route('admin.orcamentos.update', $id);
    }

    public function edit($id)
    {
        $orcamentos = new Orcamentos;
        $orcamento = $orcamentos->newQuery()
            ->findOrFail($id);

        $orcamentoKit = (new OrcamentosKits())->newQuery()
            ->where('orcamentos_id', $id)
        ->first();

        $todosStatus = (new StatusOrcamentos())->todosStatus();

        return view('pages.admin.orcamentos.edit', compact('orcamento','orcamentoKit', 'todosStatus'));
    }
}
