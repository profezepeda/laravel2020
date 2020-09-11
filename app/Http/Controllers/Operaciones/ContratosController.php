<?php

namespace App\Http\Controllers\Operaciones;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\PersonaContrato;
use App\Modelos\PersonaTipoContrato;
use App\Modelos\Cargo;

class ContratosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editar($idpersona, $idcontrato)    {
        $contrato = new PersonaContrato();
        if ((int)$idcontrato > 0)  {
            $contrato = PersonaContrato::find((int)$idcontrato);
        }
        $tiposcontrato = PersonaTipoContrato::all();
        $cargos = Cargo::all();
        return view("operaciones.editar_contrato", array("contrato" => $contrato, "idpersona" => $idpersona, "tiposcontrato" => $tiposcontrato, "cargos" => $cargos));
    }

    public function guardar(Request $request)   {
        $contrato = new PersonaContrato();
        if ($request->idcontrato != "" && $request->idcontrato > 0) {
        // if (!is_null($request->idcontrato)) {
            $contrato = PersonaContrato::find($request->idcontrato);
        } else {
            $contrato->idpersona = $request->idpersona;
        }
        $contrato->descripcion = $request->descripcion;
        $contrato->fechainicio = $request->fechainicio;
        $contrato->fechatermino = $request->fechatermino;
        $contrato->idtipocontrato = $request->idtipocontrato;
        $contrato->idturno = 1;
        $contrato->idseccion = 1;
        $contrato->idcargo = $request->idcargo;
        $contrato->estado = 1;
        $contrato->interno = 1;
        $contrato->save();

        return redirect("/personas/editar/".$request->idpersona);
    }




}
