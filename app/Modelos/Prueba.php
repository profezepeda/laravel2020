<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    public $table = 'pr_pruebas';
    public $timestamps = false;
    protected $primaryKey = 'idprueba';

    public function encargado()
    {
        return $this->belongsTo(\App\Modelos\Persona::class, "encargado_idpersona", "idpersona");
    }

    public function preguntas()
    {
        return $this->hasMany(\App\Modelos\PruebaPreguntas::class, "idprueba");
    }

    public function controles()
    {
        return $this->hasMany(\App\Modelos\PruebaControl::class, "idprueba");
    }

    public function documento()
    {
        return $this->belongsTo(\App\Modelos\PruebaDocumentos::class, "iddocumento");
    }

}
