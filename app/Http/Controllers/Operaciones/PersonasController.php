<?php

namespace App\Http\Controllers\Operaciones;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modelos\Persona;
use App\Modelos\PersonaTipoContrato;
use App\Modelos\Cargo;


class PersonasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $personas = Persona::orderBy("apellidopaterno")->orderBy("apellidomaterno")->get();
        return view("operaciones.personas", array("personas" => $personas, "titulo" => "Gestión de Personas"));
    }

    public function indexjson() {
        $personas = Persona::orderBy("apellidopaterno")->orderBy("apellidomaterno")->get();
        $p = array();
        foreach ($personas as $persona) {
            $botonera = "
            <a type=\"button\" class=\"btn btn-success btn-sm\" href=\"/personas/editar/".$persona->idpersona."\">Editar</a>
            <button type=\"button\" class=\"btn btn-danger btn-sm\" onclick=\"eliminarPersona(".$persona->idpersona.");\">Quitar</button>
            ";


            array_push($p, array($persona->rut, $persona->apellidopaterno, $persona->apellidomaterno, $persona->primernombre . " " . $persona->segundonombre, $botonera));
        }
        $retorno = array("data" => $p);

        return response($retorno);
    }

    public function editar($idpersona)  {
        $persona = new Persona();
        if ($idpersona > 0) {
            $persona = Persona::find((int)$idpersona);
        }
        $tiposcontrato = PersonaTipoContrato::all();
        $cargos = Cargo::all();
        return view("operaciones.editar_persona", array("persona" => $persona, "tiposcontrato" => $tiposcontrato, "cargos" => $cargos));
    }

    public function guardar(Request $request)   {
        $persona = new Persona();
        if ((int)$request->idpersona > 0)  {
            $persona = Persona::find((int)$request->idpersona);
        }
        $persona->rut = $request->rut;
        $persona->apellidopaterno = $request->apellidopaterno;
        $persona->apellidomaterno = $request->apellidomaterno;
        $persona->primernombre = $request->primernombre;
        $persona->segundonombre = $request->segundonombre;
        $persona->fechanacimiento = "2019-01-01";
        $persona->save();

        return redirect("/personas/editar/".$persona->idpersona);
    }

    public function eliminar(Request $request)  {
        $persona = Persona::find($request->idpersona);
        if (!$persona)      return response(array("resultado" => "error", "mensaje" => "Persona no encontrada"));
        $nombre = $persona->primernombre . " " . $persona->apellidopaterno . " " . $persona->apellidomaterno;
        try {
            $persona->delete();
        } catch (Exception $e)   {
            return response(array("resultado" => "error", "mensaje" => "No se puede eliminar por tener contratos"));
        }

        return response(array("resultado" => "ok", "mensaje" => "Persona eliminada", "nombre" => $nombre));
    }


}
