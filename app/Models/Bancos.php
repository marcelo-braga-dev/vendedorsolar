<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bancos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'juros_mensal',
        'qtd_parcelas',
        'carencia',
        'status',
        'img_logo'
    ];
}
