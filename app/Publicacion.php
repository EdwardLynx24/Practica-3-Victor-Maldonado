<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }
    public function usuarios(){
        return $this->belongsTo('\App\User');
    }
}
