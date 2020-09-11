<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $table = 'users';
    public $timestamps = false;
    protected $primaryKey = 'id';

    public function tipousuario()
    {
        return $this->belongsTo(\App\Modelos\TipoUsuario::class, "idtipousuario");
    }

    public function persona()
    {
        return $this->hasOne(\App\Modelos\Persona::class, "id");
    }

}
