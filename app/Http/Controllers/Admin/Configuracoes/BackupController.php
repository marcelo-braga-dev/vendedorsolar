<?php

namespace App\Http\Controllers\Admin\Configuracoes;

use App\Http\Controllers\Controller;

class BackupController extends Controller
{
    public function index()
    {
        return view('pages.admin.configs.backup.index');
    }

    public function create()
    {
        return response()->download(public_path('storage/exportar.zip'));
    }
}
