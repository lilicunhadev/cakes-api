<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bolo extends Model
{
    use HasFactory;
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
