<?php

namespace App\Http\Controllers\Vendedor\Visitas;

use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\VisitasTecnicas;
use App\src\VisitasTecnicas\Status\VisitasTecnicasStatus;
use App\src\VisitasTecnicas\Status\VisitaTecnicaNovaStatus;
use Illuminate\Http\Request;

class VisitasController extends Controller
{
    public function index()
    {
        $status = (new VisitaTecnicaNovaStatus())->getStatus();
        $visitas = (new VisitasTecnicas())->newQuery()
            ->where('users_id', id_usuario_atual())
            ->where('status', $status)
            ->orderBy('data')
            ->paginate();

        return view('pages.vendedor.visitas.index', compact('visitas'));
    }

    public function show($id)
    {
        $visita = (new VisitasTecnicas())->newQuery()->findOrFail($id);
        $cliente = (new Clientes())->newQuery()->findOrFail($visita->clientes_id);
        $status = (new VisitasTecnicasStatus())->todosStatus();

        return view('pages.vendedor.visitas.show',
            compact('visita', 'cliente', 'status'));
    }

    public function create()
    {
        $clientes = (new Clientes())->newQuery()
            ->where('users_id', '=', id_usuario_atual())
            ->orderBy('id', 'DESC')
            ->get();

        return view('pages.vendedor.visitas.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $status = (new VisitaTecnicaNovaStatus())->getStatus();
        (new VisitasTecnicas())->newQuery()
            ->updateOrCreate(
                ['users_id' => id_usuario_atual(), 'clientes_id' => $request->cliente, 'status' => $status],
                ['data' => $request->data]
            );
        modalSucesso('Visita agendada com sucesso!');
        return redirect()->route('vendedor.visitas.index');
    }

    public function update($id, Request $request)
    {
        (new VisitasTecnicas())->newQuery()
            ->findOrFail($id)
            ->update(['status' => $request->status]);
        modalSucesso('Dados atualizado com sucesso!');
        return redirect()->back();
    }
}
