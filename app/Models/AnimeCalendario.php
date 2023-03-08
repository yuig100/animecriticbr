<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimeCalendario extends Model
{

    use HasFactory;

    protected $fillable = [
        'nome-anime', 'estacao', 'ano'
    ];

    public function anime()
    {
        return $this->belongsTo(Anime::class, 'nome_anime');
    }
}
