@extends('layouts.app')

@section('content')

<div class="container">
    <h2>{{ $titulo }}</h2>

    <div class="row">
        <div class="col-sm-3">
            <a type="button" class="btn btn-primary" href="/personas/editar/0">Agregar</a>
        </div>
        <div class="col-sm-9">
            <div class="alert alert-success" role="alert" id="mensajeOk" style="display: none;">
                El registro de <span id="nombreOk"></span> fue eliminado satisfactoriamente
            </div>
            <div class="alert alert-danger" role="alert" id="mensajeError" style="display: none;">
                El registro no fue eliminado: <span id="errorMensaje"></span>
            </div>
        </div>
    </div>

    <table id="tabla" class="display">
        <thead>
          <tr>
            <th scope="col">RUT</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Nombres</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>


        </tbody>
      </table>

</div>

@endsection

@section("javascript")
<script>
    var tabla;
    $(document).ready( function () {
        tabla = $('#tabla').DataTable({
            "ajax": "{{ url("/personas/json/lista") }}"
        });
    } );

    function eliminarPersona(idp)   {
        if (!confirm("Está seguro de eliminar la Persona?"))    {
            return false;
        }
        $.ajax({
            url: "{{ url("/personas/eliminar") }}",
            method: "POST",
            data: { idpersona: idp }
        }).done(function( respuesta ) {
            console.log(respuesta.resultado);
            if (respuesta.resultado == "ok")    {
                console.log("hola");
                $("#mensajeOk").css("display", "block");
                $("#nombreOk").html(respuesta.nombre);
                tabla.ajax.reload();
                setTimeout(function() {$("#mensajeOk").css("display", "none"); }, 3000);
            } else {
                $("#mensajeError").css("display", "block");
                $("#errorMensaje").html(respuesta.mensaje);
                setTimeout(function() {$("#mensajeError").css("display", "none"); }, 3000);
            }
        }).fail(function (error) {
            $("#mensajeError").css("display", "block");
            $("#errorMensaje").html("Persona con contratos dependientes");
            setTimeout(function() {$("#mensajeError").css("display", "none"); }, 3000);
        });


    }



</script>
@endsection
