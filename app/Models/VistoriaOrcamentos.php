<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VistoriaOrcamentos extends Model
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
        'observacoes'
    ];
}
