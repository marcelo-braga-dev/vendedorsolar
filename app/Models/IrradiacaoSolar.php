<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrradiacaoSolar extends Model
{
    use HasFactory;

    protected $fillable = [
        'media',
        'jan',
        'fev',
        'mar',
        'abr',
        'mai',
        'jun',
        'jul',
        'ago',
        'set',
        'out',
        'nov',
        'dez',
    ];

    public function todasIrradiacoes($cidade)
    {
        return $this->newQuery()
            ->where('cidades_estados_id', '=', $cidade)->first();
    }
}
