<?php

function getIdLocalidadeIntegracao($cidade, $estado)
{
    $dados = (new \App\Models\CidadesEstados())->newQuery()
        ->where('cidade', $cidade)
        ->where('sigla', $estado)
        ->first();
    if (empty($dados)) return 1;
    return $dados->id;
}
