<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuiaDeTemporada extends Model
{
    protected $table = 'guia_de_temporada';

    protected $casts = [
        'items' => 'array'
    ];

    protected $dates = ['date'];

    protected $guarded = [];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function getImageAttribute($value)
    {
        return asset('img/guiadetemporada/' . $value);
    }
    public function categoria() {
        return $this->belongsTo('App\Models\Categoria', 'id_categoria');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
