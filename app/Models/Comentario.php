<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'comentario',
        'id_user',
        'id_publicacao',
        'id_parent',
        'up_votos',
        'down_votos',
        'publicacao_type',
        'visivel',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function publicacao()
    {
        return $this->morphTo();
    }

    public function children()
    {
        return $this->hasMany(Comentario::class, 'id_parent')->with('user', 'children');
    }

    public function parent()
    {
        return $this->belongsTo(Comentario::class, 'id_parent')->with('user');
    }

    public function scopeParentComment($query)
    {
        return $query->whereNull('id_parent');
    }
}
