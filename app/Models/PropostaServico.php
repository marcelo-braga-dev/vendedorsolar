<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PropostaServico extends Model
{
    protected $fillable = [
        'consultor_id',
        'cliente_id',
        'valor',
        'prazo_final',
        'titulo',
        'descricao',
    ];

    protected $with = ['cliente', 'vendedor'];

    public function getPrazoFinalAttribute()
    {
        return Carbon::parse($this->attributes['prazo_final'])->format('d/m/Y');
    }

    public function setValorAttribute($value)
    {
        $this->attributes['valor'] = $value ? convert_money_float($value) : null;
    }

    public function cliente()
    {
        return $this->hasOne(Clientes::class, 'id', 'cliente_id');

    }

    public function vendedor()
    {
        return $this->hasOne(User::class, 'id', 'consultor_id');

    }
}
