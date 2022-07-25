<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecificacaoMetas extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta',
        'meta_key',
        'value'
    ];

    public function getEstado($estado): ?float
    {
        return $this->newQuery()
            ->where('meta', '=', 'estados')
            ->where('meta_key', '=', $estado)
            ->first(['meta_key', 'value'])->value ?? null;
    }

    public function getEstados(): array
    {
        $items = $this->newQuery()
            ->where('meta', '=', 'estados')
            ->get(['meta_key', 'value']);

        $margens = [];
        foreach ($items as $item) {
            $margens[$item->meta_key] = $item->value;
        }
        return $margens;
    }

    public function updateEstados($dados)
    {
        $dados = $dados->except('_token');

        foreach ($dados as $index => $dado) {
            $this->newQuery()
                ->updateOrCreate(
                    ['meta' => 'estados', 'meta_key' => $index],
                    ['value' => $dado]);
        }
    }
}
