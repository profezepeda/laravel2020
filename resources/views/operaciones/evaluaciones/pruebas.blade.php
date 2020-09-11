@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Evaluaciones</h2>

    <a type="button" class="btn btn-primary" href="/evaluaciones/editar/0">Agregar</a>

    <table id="tablaPruebas" class="display">
        <thead>
          <tr>
            <th scope="col">Fecha</th>
            <th scope="col">Documento</th>
            <th scope="col">Encargado</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($pruebas as $elemento)

                <tr>
                    <td>{{ \Carbon\Carbon::parse($elemento->fecha)->format("d/m/Y") }}</td>
                    <td>{{ $elemento->documento->nombre }}</td>
                    <td>{{ $elemento->encargado->apellidopaterno }}</td>
                    <td>
                        <a type="button" class="btn btn-success btn-sm" href="/evaluaciones/editar/{{ $elemento->idprueba }}">Editar</a>
                    </td>
                </tr>

            @endforeach
        </tbody>
      </table>

</div>

@endsection


@section("javascript")
<script>
    $(document).ready( function () {
        $('#tablaPruebas').DataTable();
    } );
</script>
@endsection

