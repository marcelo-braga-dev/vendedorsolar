<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitasTecnicas extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'clientes_id',
        'data',
        'status',
        'anotacoes'
    ];
}
