<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Prueba;
use App\Modelos\PruebaDocumentos;
use App\Modelos\PruebaControl;
use App\Modelos\Persona;

class PruebasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $pruebas = Prueba::limit(10)->orderBy("fecha", "desc")->get();
        return view("operaciones.evaluaciones.pruebas", array("pruebas" => $pruebas));
    }

    public function editar($idprueba)    {
        $prueba = new Prueba();
        if ($idprueba > 0)  {
            $prueba = Prueba::find($idprueba);
        }
        $documentos = PruebaDocumentos::all();
        $encargados = Persona::all();
        $personas = Persona::all();
        return view("operaciones.evaluaciones.editar_prueba", array("prueba" => $prueba, "documentos" => $documentos, "encargados" => $encargados, "personas" => $personas));
    }

    public function guardar(Request $request)   {
        $prueba = new Prueba();
        if ($request->idprueba > 0) {
            $prueba = Prueba::find($request->idprueba);
        }
        $prueba->fecha = $request->fecha;
        $prueba->encargado_idpersona = $request->encargado_idpersona;
        $prueba->iddocumento = $request->iddocumento;
        $prueba->habilitado = 1;
        $prueba->save();
        return redirect("/evaluaciones/editar/".$prueba->idprueba);

    }

    public function agregarasistentes(Request $request) {
        if (!isset($request->idpersona) || !isset($request->idprueba))  {
            return redirect("/evaluaciones");
        }

        $control = PruebaControl::where("idprueba", $request->idprueba)->where("idpersona", $request->idpersona)->first();
        if (!$control)   {
            $control = new PruebaControl();
            $control->idprueba = $request->idprueba;
            $control->idpersona = $request->idpersona;
            $control->inicio = \Carbon\Carbon::now()->format("Y-m-d");
            $control->puntaje = 0;
            $control->save();
        } else {
            // mensaje de uqe persona ya está asignada a la evaluación
        }
        return redirect("/evaluaciones/editar/".$request->idprueba);
    }

    public function quitarasistentes(Request $request)  {
        $control = PruebaControl::where("idprueba", $request->idprueba)->where("idpersona", $request->idpersona)->first();
        $control->delete();
        return redirect("/evaluaciones/editar/".$request->idprueba);
    }


}
