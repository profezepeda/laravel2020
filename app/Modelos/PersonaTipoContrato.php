<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PersonaTipoContrato extends Model
{
    public $table = 'ptiposcontrato';
    public $timestamps = false;
    protected $primaryKey = 'idtipocontrato';

    public function contratos() {
        return $this->hasMany(\App\Modelos\PersonaContrato::class, "idtipocontrato");
    }

}
