<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentosVistorias extends Model
{
    use HasFactory;

    protected $fillable = [
        'orcamentos_id',
        'largura_telhado',
        'altura_telhado',
        'slug_disjuntor',
        'slug_padrao_energia',
        'slug_telhado',
        'slug_fiacao',
        'slug_medidor',
        'slug_outros',
        'slug_arquivo_1',
        'slug_arquivo_2',
        'slug_arquivo_2',
        'observacoes'
    ];
}
