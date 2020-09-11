<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    public $table = 'cargos';
    public $timestamps = false;
    protected $primaryKey = 'idcargo';

    public function contratos()
    {
        return $this->belongsToMany(\App\Modelos\PersonaContrato::class, "idcargo");
    }

}
