<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PruebaPreguntas extends Model
{
    public $table = 'pr_pruebaspreguntas';
    public $timestamps = false;
    protected $primaryKey = 'idpregunta';

    public function prueba()
    {
        return $this->belongsTo(\App\Modelos\Prueba::class, "idprueba");
    }

    public function controlrespuestas() {
        return $this->hasMany(\App\Modelos\ControlRespuestas::class, "idpregunta");
    }

}
