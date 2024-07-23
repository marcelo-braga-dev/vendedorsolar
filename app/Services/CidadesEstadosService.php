<?php

namespace App\Services;

use App\Models\CidadesEstados;

class CidadesEstadosService
{
    static function getCidades()
    {
        $cidadesEstados = (new CidadesEstados)->orderBy('sigla', 'ASC')
            ->orderBy('cidade', 'ASC')
            ->get();

        $cidades = [];
        foreach ($cidadesEstados as $item) {
            $cidades[$item->sigla][] = $item->toArray();
        }
        return $cidades;
    }

    static function getEstados()
    {
        return (new CidadesEstados)->orderBy('sigla', 'ASC')
            ->distinct()
            ->get(['sigla', 'estado']);
    }

    public function getCidadeEstado(int $id): string
    {
        $dados = (new CidadesEstados())->newQuery()
            ->where('id', '=', $id)
            ->first(['cidade', 'sigla']);

        if (empty($dados)) return '';
        return $dados->cidade . '/' . $dados->sigla;
    }
}
