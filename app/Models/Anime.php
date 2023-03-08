<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'image', 'sinopse', 'dia_da_semana'
    ];

    protected $casts = [
        'items' => 'array'
    ];

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function getImageAttribute($value)
    {
        return asset('img/calendario/'.$this->ano.'/'.$this->estacao.'/'.$value);

        if (!is_dir(public_path($path))) {
            mkdir(public_path($path), 0755, true);
        }
        return asset($path);
    }

    public function calendarios()
    {
        return $this->hasMany(AnimeCalendario::class, 'nome_anime');
    }
}
