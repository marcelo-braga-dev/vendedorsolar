<?php
$orcamentos = (new \App\Models\Orcamentos())->newQuery()->get();
$info = (new \App\Models\OrcamentosInfos())->newQuery();

foreach ($orcamentos as $orcamento) {
    $metas = (new \App\Models\OrcamentosMetas())->newQuery()
        ->where('orcamentos_id', $orcamento->id)->get();

    $dados = [];
    foreach ($metas as $meta) {
        $dados[$meta->meta_key] = $meta->value;
    }
    $consumo = $dados['consumo'];
    if (empty($consumo)) $consumo = null;
    $info->create([
        'orcamentos_id' => $orcamento->id,
        'consumo' =>  $consumo,
        'consumo_ponta' => $dados['consumo_ponta'],
        'consumo_fora_ponta' => $dados['consumo_fora_ponta'],
        'demanda' => $dados['demanda'],
        'estrutura' => $dados['estrutura'],
        'tensao' => $dados['tensao'],
        'orientacao' => $dados['orientacao']
    ]);
}
