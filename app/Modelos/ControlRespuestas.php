<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class ControlRespuestas extends Model
{
    public $table = 'pr:controlresp';
    public $timestamps = false;
    protected $primaryKey = 'idrespuesta';

    public function control()
    {
        return $this->belongsTo(\App\Modelos\PruebaControl::class, "idcontrol");
    }

    public function preguntas()
    {
        return $this->belongsTo(\App\Modelos\PruebaPreguntas::class, "idpregunta");
    }

}
