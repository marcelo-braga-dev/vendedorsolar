<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrcamentosMetas extends Model
{
    use HasFactory;

    public function getMetas($id)
    {
        return (new OrcamentosInfos())->newQuery()
            ->where('orcamentos_id', $id)->first();
    }
}
