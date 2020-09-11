<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    public $table = 'tiposusuario';
    public $timestamps = false;
    protected $primaryKey = 'idtipousuario';

    public function usuarios()
    {
        return $this->hasMany(\App\Modelos\User::class, "idtipousuario");
    }


}
