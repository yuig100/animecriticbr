<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'anime_calendario';

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
        return asset('img/calendario/'.$this->ano.'/'.$this->estacao.'/'.$value);
    }
}
