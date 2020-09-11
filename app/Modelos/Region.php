<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $table = 'regiones';
    public $timestamps = false;
    protected $primaryKey = 'idregion';

    // belongsTo    n..1
    // hasMany      1..n

    public function comunas()  {
        return $this->hasMany(\App\Modelos\Comuna::class, "idregion");
    }


}
