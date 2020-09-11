@extends('layouts.app')

@section('content')

<div class="container">
    <h2>
        @if ($prueba->idprueba == null)
            Nueva evaluación
        @else
            Evaluación
        @endif
    </h2>

    <form class="border border-light p-5" method="POST" action="/evaluaciones/guardar">
        @csrf
        <input type="hidden" id="idprueba" name="idprueba" value="{{ $prueba->idprueba }}" />

        <div class="row">
            <div class="md-form col-sm m-0">
                <input placeholder="Fecha" type="text" id="fecha" name="fecha" class="form-control datepicker" value="{{ $prueba->fecha }}" required="true">
                <label for="fecha">Fecha</label>
            </div>
            <div class="md-form col-sm m-0">
                <select class="browser-default custom-select" id="iddocumento" name="iddocumento">
                    @foreach ($documentos as $documento)
                        <option value="{{ $documento->iddocumento }}"
                            @if ($documento->iddocumento == $prueba->iddocumento)
                                selected="true"
                            @endif
                            >{{ $documento->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="md-form col-sm m-0">
                <select class="browser-default custom-select" id="encargado_idpersona" name="encargado_idpersona">
                    @foreach ($encargados as $encargado)
                        <option value="{{ $encargado->idpersona }}"
                            @if ($encargado->idpersona == $prueba->encargado_idpersona)
                                selected="true"
                            @endif
                            >{{ $encargado->nombre }} {{ $encargado->apellidopaterno }} {{ $encargado->apellidomaterno }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="row">
            <button type="submit" class="btn btn-success" id="botonGuardar" name="botonGuardar">Guardar</button>
            <a type="button" class="btn btn-default" href="/evaluaciones">Cancelar</a>
        </div>

    </form>

    @if (!is_null($prueba->idprueba))

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Asistentes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Preguntas</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <form class="row p-5" name="formAsistentes" id="formAsistentes" method="POST" action="/evaluaciones/asistentes/agregar">
                @csrf
                <input type="hidden" name="idprueba" value="{{ $prueba->idprueba }}" />

                <div class="col-8">
                    <select class="browser-default custom-select " name="idpersona" id="asistente_idpersona">

                        @foreach ($personas as $persona)
                            <option value="{{ $persona->idpersona }}">{{ $persona->apellidopaterno }} {{ $persona->apellidomaterno }} {{ $persona->primernombre }} {{ $persona->segundonombre }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="col-4">
                    <button type="submit" class="btn-sm btn-warning" id="botonAgregar" name="botonAgregar">Agregar</button>
                </div>

            </form>
            <form name="formEliminar" id="formEliminar" method="POST" action="/evaluaciones/asistentes/quitar">
                @csrf
                <input type="hidden" name="idprueba" value="{{ $prueba->idprueba }}" />
                <input type="hidden" name="idpersona" id="delPersona" value="" />
            </form>

            <table id="tablaPersonas" class="display">
                <thead>
                    <tr>
                    <th scope="col">RUT</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($prueba->controles as $control)
                        <tr>
                            <td>{{ $control->persona->rut }}</td>
                            <td>{{ $control->persona->apellidopaterno }} {{ $control->persona->apellidomaterno }} {{ $control->persona->primernombre }} {{ $control->persona->segundonombre }}</td>
                            <td>{{ $control->persona->email_corporativo }}</td>
                            <td>
                                <button type="button" class="btn-danger btn-sm" onclick="eliminarAsistente({{ $control->persona->idpersona }})">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <table id="tablaPreguntas" class="display">
                <thead>
                    <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Pregunta</th>
                    <th scope="col">Alternativas</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($prueba->preguntas as $pregunta)
                        <tr>
                            <td>{{ $pregunta->numero }}</td>
                            <td>{{ $pregunta->pregunta }}</td>
                            <td>
                                <ol type="a">
                                    <li>{{ $pregunta->alternativa_a }}</li>
                                    <li>{{ $pregunta->alternativa_b }}</li>
                                    <li>{{ $pregunta->alternativa_c }}</li>
                                    <li>{{ $pregunta->alternativa_d }}</li>
                                </ol>
                            </td>
                            <td>

                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>

    @endif


</div>


<script>
function eliminarAsistente(idp)    {
    if (!confirm("Está seguro de quitar el asistente?"))    return false;
    if (!confirm("Está completamente seguro?"))             return false;
    if (!confirm("Seguro?"))                                return false;
    document.getElementById("delPersona").value = idp;
    document.getElementById("formEliminar").submit();
}
</script>



@endsection


@section("javascript")
<script>
    $(document).ready( function () {
        $('#tablaPersonas').DataTable();
        $('#tablaPreguntas').DataTable();
        $('#encargado_idpersona').select2();
        $("#asistente_idpersona").select2();
    } );
</script>
@endsection

