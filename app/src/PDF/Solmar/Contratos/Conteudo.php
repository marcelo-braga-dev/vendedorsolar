<?php

namespace App\src\PDF\Solmar\Contratos;

use App\Models\Contratos;

class Conteudo
{
    public function index($dados, $id)
    {
        $contrato = (new Contratos())->newQuery()->findOrFail($id);

        $dados->mpdf->WriteHTML(view('pages.pdf.solmar.contrato.conteudo',
            compact('contrato')));

        return $dados->mpdf;
    }
}
