<?php

namespace App\Models\Integracao\Edeltec;

use Illuminate\Database\Eloquent\Model;

class IntegracaoEdeltecHistorico extends Model
{
    protected $fillable = [
        'status',
        'data_inicio',
        'data_fim',
        'data_fim',
        'produtos_importados',
        'qtd_importados',
        'produtos_desativados',
        'qtd_desativados',
        'anotacoes',
    ];

    protected $casts = [
        'produtos_importados' => 'array',
        'produtos_desativados' => 'array',
        'data_inicio' => 'datetime',
        'data_fim' => 'datetime',
    ];

}
