<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratos extends Model
{
    use HasFactory;

    protected $appends = ['contrato_data'];

    function getContratoDataAttribute()
    {
        return Carbon::parse($this->created_at)
            ->locale('pt_BR')
            ->translatedFormat('d \d\e F \d\e Y');
    }
}
