<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class PruebaDocumentos extends Model
{
    public $table = 'pr_documentos';
    public $timestamps = false;
    protected $primaryKey = 'iddocumento';

    public function pruebas()
    {
        return $this->hasMany(\App\Modelos\Prueba::class, "iddocumento");
    }

}
