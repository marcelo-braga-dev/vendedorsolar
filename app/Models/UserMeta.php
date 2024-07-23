<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'users_id',
        'meta',
        'value'
    ];

    public function salvar(int $user, string $meta, ?string $value)
    {
        $this->newQuery()
            ->updateOrInsert(
                ['users_id' => $user, 'meta' => $meta], ['value' => $value]
            );
    }

    public function metas($id)
    {
        $dados = $this->newQuery()
            ->where('users_id', '=', $id)->get();

        $res = [];
        foreach ($dados as $dado) {
            $res[$dado->meta] = $dado->value;
        }

        return $res;
    }

    public function updateMeta($id, $chave, $valor)
    {
        $this->newQuery()
            ->updateOrCreate(
                ['users_id' => $id, 'meta' => $chave],
                ['value' => $valor]
            );
    }
}
