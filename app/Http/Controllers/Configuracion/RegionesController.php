<?php

namespace App\Http\Controllers\Configuracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Region;
use App\Modelos\Comuna;

class RegionesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()  {
        /*
        $regiones = Region::all();
        dd($regiones);
        */
        $comuna = Comuna::find(4);
        dd($comuna->region->region);
    }
}
