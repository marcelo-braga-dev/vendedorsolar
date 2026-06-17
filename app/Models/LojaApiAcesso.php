<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LojaApiAcesso extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'metodo',
        'rota',
        'parametros',
        'sku',
        'status',
    ];
}
