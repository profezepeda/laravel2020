<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PersonaContrato extends Model
{
    public $table = 'pcontratos';
    public $timestamps = false;
    protected $primaryKey = 'idpcontrato';

    public function persona()
    {
        return $this->belongsTo(\App\Modelos\Persona::class, "idpersona");
    }

    public function tipocontrato()
    {
        return $this->belongsTo(\App\Modelos\PersonaTipoContrato::class, "idtipocontrato");
    }

    public function cargo()
    {
        return $this->belongsTo(\App\Modelos\Cargo::class, "idcargo");
    }


}
