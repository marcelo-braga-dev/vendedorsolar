<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentosMetas extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'orcamentos_id',
        'meta_key',
        'value'
    ];

    public function criar($id, $key, $value)
    {
        $this->newQuery()
            ->create([
                'orcamentos_id' => $id,
                'meta_key' => $key,
                'value' => $value
            ]);
    }

    public function getMetas($id)
    {
        $orcamentosMetas = $this->newQuery()
            ->where('orcamentos_id', '=', $id)
            ->get();

        $metas = [];
        foreach ($orcamentosMetas as $item) {
            $metas[$item->meta_key] = $item->value;
        }

        return $metas;
    }
}
