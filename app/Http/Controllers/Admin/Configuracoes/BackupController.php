<?php

namespace App\Http\Controllers\Admin\Configuracoes;

class BackupController
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
