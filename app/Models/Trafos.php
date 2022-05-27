<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trafos extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'sku',
        'modelo',
        'produtos_id',
        'potencia',
        'margem',
        'preco_cliente',
        'preco_fornecedor',
        'fornecedor',
        'status',
        'status_fornecedor',
        'observacoes'
    ];
}
