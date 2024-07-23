<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configs extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_key',
        'meta',
        'value'
    ];

    public function getInfo(string $key)
    {
        $info = $this->newQuery()
            ->where('meta', '=', $key)
            ->first('value');

        return $info->value;
    }
}
