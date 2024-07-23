<?php

namespace App\Http\Controllers\Vendedor\Clientes;

use App\Http\Controllers\Controller;
use App\Models\Leads;
use App\src\Clientes\Leads\Status\StatusLeads;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    public function index()
    {
        $leads = (new Leads())->newQuery()
            ->where('vendedor', id_usuario_atual())
            ->orderByDesc('id')
            ->paginate();

        return view('pages.vendedor.clientes.leads.index', compact('leads'));
    }

    public function show($id)
    {
        $lead = (new Leads())->newQuery()
            ->where('id', $id)
            ->where('vendedor', id_usuario_atual())
            ->firstOrFail();
        $status = (new StatusLeads())->todosStatus();

        return view('pages.vendedor.clientes.leads.show', compact('lead', 'status'));
    }

    public function update($id, Request $request)
    {
        (new Leads())->newQuery()->findOrFail($id)
            ->update(['status' => $request->status]);
        modalSucesso('Informações atualizadas com sucesso!');

        return redirect()->back();
    }
}
