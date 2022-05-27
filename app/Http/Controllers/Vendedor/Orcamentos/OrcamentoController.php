<?php

namespace App\Http\Controllers\Vendedor\Orcamentos;

use App\Http\Controllers\Controller;
use App\Models\Kits;
use App\Models\Orcamentos;
use App\Models\OrcamentosMetas;
use App\Models\Produtos;
use App\Models\Trafos;
use App\src\Orcamentos\Status\Aprovado;
use App\src\Orcamentos\Status\Assinado;
use App\src\Orcamentos\Status\Finalizado;
use App\src\Orcamentos\Status\Instalando;
use App\src\Orcamentos\Status\Novo;
use Illuminate\Http\Request;

class OrcamentoController extends Controller
{
    public function index(Request $request)
    {
        $where = $this->getStatus($request->status);

        $orc = new Orcamentos();
        $orcamentos = $orc->newQuery()
            ->where('users_id', '=', id_usuario_atual())
            ->where($where)
            ->orderBy('id', 'DESC')
            ->paginate();

        return view('pages.vendedor.orcamentos.index', compact('orcamentos'));
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
            case 'instalandos' :
                $tag = (new Instalando())->getStatus();
                break;
            case 'finalizados' :
                $tag = (new Finalizado())->getStatus();
                break;
            default :
                return null;
        }

        return [['status', '=', $tag]];
    }

    public function show($id)
    {
        $orcamentos = new Orcamentos();
        $orcamento = $orcamentos->newQuery()
            ->findOrFail($id);

        if ($orcamento->users_id != id_usuario_atual()) {
            modalErro('Voce não tem permissão para acessar esse orcamento');
            return redirect()->back();
        }

        $kits = new Kits();
        $kit = $kits->newQuery()
            ->find($orcamento->kits_id);

        $trafos = new Trafos();
        $trafo = $trafos->newQuery()->find($orcamento->trafo);

        $produtos = new Produtos();
        $imagens = $produtos->getImagensNome();

        $metas = (new OrcamentosMetas())->getMetas($orcamento->id);

        return view('pages.vendedor.orcamentos.show',
            compact('orcamento', 'kit', 'trafo', 'imagens', 'metas'));
    }
}
