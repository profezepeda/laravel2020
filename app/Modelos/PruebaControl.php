<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PruebaControl extends Model
{
    public $table = 'pr_control';
    public $timestamps = false;
    protected $primaryKey = 'idcontrol';

    public function persona()
    {
        return $this->belongsTo(\App\Modelos\Persona::class, "idpersona");
    }

    public function prueba()
    {
        return $this->belongsTo(\App\Modelos\Prueba::class, "idprueba");
    }

    public function controlrespuestas()
    {
        return $this->hasMany(\App\Modelos\ControlRespuestas::class, "idcontrol");
    }


}
