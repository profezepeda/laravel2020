<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $table = 'personas';
    public $timestamps = false;
    protected $primaryKey = 'idpersona';

    protected $fillable = [ "rut", "primernombre", "segundonombre", "apellidopaterno", "apellidomaterno",
                            "fechanacimiento", "sexo"];

    public function usuario()
    {
        return $this->hasOne(\App\Modelos\User::class, "id");
    }

    public function contratos() {
        return $this->hasMany(\App\Modelos\PersonaContrato::class, "idpersona");
    }

}
