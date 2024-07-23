<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegracaoHistorico extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornecedores_id',
        'origem',
        'status',
        'alertas'
    ];
}
