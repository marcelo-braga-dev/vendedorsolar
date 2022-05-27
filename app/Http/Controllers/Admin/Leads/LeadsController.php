<?php

namespace App\Http\Controllers\Admin\Leads;

use App\Models\Clientes;

class LeadsController
{
    public function index()
    {
        $clsClientes = new Clientes();
        $clientes = $clsClientes->newQuery()
            ->get();

        return view('pages.admin.leads.index', compact('clientes'));
    }
}
