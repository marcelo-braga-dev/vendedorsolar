<?php

namespace App\Http\Controllers\Admin\Leads;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\Models\User;
use App\src\Clientes\Leads\Status\LeadFinalizado;
use App\src\Clientes\Leads\Status\LeadNovo;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $query = $this->getQuery($status);

        $leads = (new Leads())->newQuery()
            ->where($query)
            ->orderByDesc('id')
            ->paginate();

        return view('pages.admin.leads.index', compact('leads', 'status'));
    }

    public function show($id)
    {
        $lead = (new Leads())->newQuery()->findOrFail($id);
        $vendedores = (new User())->vendedores();

        if ($lead->status == 'finalizado') return view('pages.admin.leads.finalizados.show', compact('lead', 'vendedores'));
        if (is_int($lead->vendedor)) return view('pages.admin.leads.encaminhados.show', compact('lead', 'vendedores'));
        return view('pages.admin.leads.novo.show', compact('lead', 'vendedores'));
    }

    public function update($id, Request $request)
    {
        (new Leads())->newQuery()->findOrFail($id)
            ->update(['vendedor' => $request->vendedor]);
        modalSucesso('Informações atualizadas com sucesso!');

        return redirect()->back();
    }

    private function getQuery($status): array
    {
        $novo = (new LeadNovo())->getStatus();
        $finalizado = (new LeadFinalizado())->getStatus();

        if ($status == 'encaminhados') return [
            ['vendedor', '!=', null], ['status', '=', $novo]];
        if ($status == 'finalizado') return [['status', '=', $finalizado]];
        return [['vendedor', null]];
    }
}
