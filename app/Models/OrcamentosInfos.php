<?php

namespace App\Models;

use App\src\Orcamentos\ChavesOrcamentos;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentosInfos extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'orcamentos_id',
        'consumo',
        'consumo_ponta',
        'consumo_fora_ponta',
        'demanda',
        'bloquear_edicao',
        'estrutura',
        'tensao',
        'orientacao'
    ];

    function criar(int $id, $dados)
    {
        $this->newQuery()
            ->create([
                'orcamentos_id' => $id,
                'consumo' => $dados->getConsumo(),
                'consumo_ponta' => $dados->getConsumoPonta(),
                'consumo_fora_ponta' => $dados->getConsumoForaPonta(),
                'demanda' => $dados->getDemandaContratada(),
                'estrutura' => $dados->getEstrutura(),
                'tensao' => $dados->getTensao(),
                'orientacao' => $dados->getOrientacao(),
            ]);
    }

    function dado($id)
    {
        return $this->newQuery()
            ->where('orcamentos_id', $id)->first();
    }

    public function bloquear($id, bool $dado)
    {
        $this->newQuery()
            ->where('orcamentos_id', $id)
            ->update(['bloquear_edicao' => $dado]);
    }

    public function statusBloqueio($id)
    {
        return $this->newQuery()
            ->where('orcamentos_id', $id)->first()->bloquear_edicao;
    }
}
