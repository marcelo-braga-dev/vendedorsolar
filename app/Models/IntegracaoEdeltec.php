<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntegracaoEdeltec extends Model
{
    use HasFactory;

    protected $fillable = [
        'produto_id',
        'categoria',
        'nome',
        'potencia',
    ];

    public function dados()
    {
        return $this->newQuery()
            ->pluck('produto_id', 'nome');
    }
}
