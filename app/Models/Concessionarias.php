<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concessionarias extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'estado',
        'convencional',
        'ponta',
        'intermediaria',
        'fora_ponta'
    ];
}
