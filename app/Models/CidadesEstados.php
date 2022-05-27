<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CidadesEstados extends Model
{
    use HasFactory;

    protected $fillable = ['cidade', 'estado', 'sigla'];

    public function dados($id)
    {
        return $this->newQuery()
            ->find($id);
    }
}
