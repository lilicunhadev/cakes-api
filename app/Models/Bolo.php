<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bolo extends Model
{
    protected $fillable = [
        'nome',
        'peso',
        'valor',
        'quantidade_disponivel',
        'emails_interessados',
    ];

    protected $casts = [
        'emails_interessados' => 'array',
    ];
}
