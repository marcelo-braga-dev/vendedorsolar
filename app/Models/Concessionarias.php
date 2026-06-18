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

    /**
     * Concessionária representativa de um estado, usada como aproximação
     * quando não há seleção manual (ex.: fluxo de payback do Convencional).
     * Estados com múltiplas distribuidoras (SP, SC, RS...) sempre retornam
     * a mesma (a de menor id) — não reflete necessariamente a distribuidora
     * real do cliente.
     */
    public function porEstado(string $sigla)
    {
        return $this->newQuery()
            ->where('estado', '=', $sigla)
            ->orderBy('id')
            ->first();
    }
}
