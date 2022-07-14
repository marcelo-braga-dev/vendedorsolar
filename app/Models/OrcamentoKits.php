<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentoKits extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'orcamentos_id',
        'kits_id',
        'qtd_kits',
        'preco_cliente',
        'preco_fornecedor',
        'taxa_comissao'
    ];
}
