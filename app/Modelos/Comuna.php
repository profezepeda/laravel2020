<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    public $table = 'comunas';
    public $timestamps = false;
    protected $primaryKey = 'idcomuna';

    // belongsTo    n..1
    // hasMany      1..n

    public function region()    {
        return $this->belongsTo(\App\Modelos\Region::class, "idregion");
    }



}
