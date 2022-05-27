<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MargemVendaEstruturas extends Model
{
    use HasFactory;

    protected $fillable = [
        'estruturas_id',
        'margem'
    ];
}
