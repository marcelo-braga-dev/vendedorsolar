<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\Kits;
use App\Models\OrcamentosKits;
use App\Models\Orcamentos;
use App\Models\OrcamentosInfos;
use App\Models\OrcamentosMetas;
use App\Models\Produtos;
use App\Models\Trafos;
use App\Services\Orcamentos\ComissaoVendedorService;
use App\src\Orcamentos\Status\Aprovado;
use App\src\Orcamentos\Status\Assinado;
use App\src\Orcamentos\Status\Finalizado;
use App\src\Orcamentos\Status\Instalando;
use App\src\Orcamentos\Status\Novo;
use Illuminate\Http\Request;

class OrcamentosController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $where = $this->getStatus($status);
        $whereCliente = null;

        $orcamentos = (new Orcamentos())->newQuery()
            ->where('users_id', '=', id_usuario_atual())
            ->where($where)
            ->where($whereCliente)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('pages.vendedor.orcamentos.index',
            compact('orcamentos', 'status'));
    }

    public function update($id, Request $request)
    {
        (new OrcamentosInfos())->newQuery()
            ->where('orcamentos_id', $id)
            ->update([
                'anotacoes' => $request->anotacoes
            ]);
        modalSucesso('Dados atualizados');
        return redirect()->back();
    }

    private function getStatus(?string $status)
    {
        switch ($status) {
            case 'novos' :
                $tag = (new Novo())->getStatus();
                break;
            case 'assinados' :
                $tag = (new Assinado())->getStatus();
                break;
            case 'aprovados' :
                $tag = (new Aprovado())->getStatus();
                break;
            default :
                return null;
        }

        return [['status', '=', $tag]];
    }

    public function show($id)
    {
        $orcamento = (new Orcamentos())->newQuery()->findOrFail($id);

        if ($orcamento->users_id != id_usuario_atual()) {
            modalErro('Voce não tem permissão para acessar esse orcamento');
            return redirect()->back();
        }

        $trafo = (new Trafos())->newQuery()->find($orcamento->trafo);
        $imagens = (new Produtos())->getDados();
        $metas = (new OrcamentosInfos())->dado($orcamento->id);
        $orcamentoKit = (new OrcamentosKits())->dado($orcamento->id);
        $kit = (new Kits())->newQuery()->find($orcamentoKit->kits_id);
        $comissao = (new ComissaoVendedorService())->calcular($trafo, $orcamento, $kit, $orcamentoKit);

        return view('pages.vendedor.orcamentos.show',
            compact('orcamento', 'kit', 'trafo', 'imagens', 'metas', 'orcamentoKit', 'comissao'));
    }
}
