<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MargensVenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'potencia',
        'margem'
    ];

    public function padrao()
    {
        return $this->newQuery()
            ->where('nome', '=', 'padrao')
            ->orderBy('potencia')
            ->get(['id', 'potencia', 'margem', 'updated_at']);
    }
}
