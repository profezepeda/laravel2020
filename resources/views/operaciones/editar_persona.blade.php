@extends('layouts.app')

@section('content')

<div class="container">
    <h2>
        @if ($persona->idpersona == null)
            Nueva persona
        @else
            Edición
        @endif
    </h2>

    <form class="border border-light p-5" method="POST" action="/personas/guardar">
        @csrf
        <input type="hidden" id="idpersona" name="idpersona" value="{{ $persona->idpersona }}" />

        <div class="row">
            <div class="md-form col-sm m-0">
                <input name="rut" type="text" id="rut" class="form-control" maxlength="12" required value="{{ $persona->rut }}">
                <label for="rut">RUT</label>
            </div>
            <div class="md-form col-sm"></div>
            <div class="md-form col-sm"></div>
        </div>
        <div class="row">
            <div class="md-form col-sm m-0">
                <input name="apellidopaterno" type="text" id="apellidopaterno" class="form-control" maxlength="45" required value="{{ $persona->apellidopaterno }}">
                <label for="apellidopaterno">Apellido Paterno</label>
            </div>
            <div class="md-form col-sm m-0">
                <input name="apellidomaterno" type="text" id="apellidomaterno" class="form-control" maxlength="45" required value="{{ $persona->apellidomaterno }}">
                <label for="apellidomaterno">Apellido Materno</label>
            </div>
        </div>
        <div class="row">
            <div class="md-form col-sm m-0">
                <input name="primernombre" type="text" id="primernombre" class="form-control" maxlength="45" required value="{{ $persona->primernombre }}">
                <label for="primernombre">Primer Nombre</label>
            </div>
            <div class="md-form col-sm m-0">
                <input name="segundonombre" type="text" id="segundonombre" class="form-control" maxlength="45" required value="{{ $persona->segundonombre }}">
                <label for="segundonombre">Segundo Nombre</label>
            </div>
        </div>
        <div class="row">
            <button type="submit" class="btn btn-success" id="botonGuardar" name="botonGuardar">Guardar</button>
            <a type="button" class="btn btn-default" href="/personas">Cancelar</a>
        </div>

    </form>

    @if ($persona->idpersona > 0)
        <h4>Contratos</h4>


        <a type="button" class="btn btn-primary" href="/personas/contrato/editar/{{ $persona->idpersona }}/0" data-toggle="modal" data-target="#modalEdicion">Agregar Contrato</a>

        <table id="tabla" class="display">
            <thead>
              <tr>
                <th scope="col">Descripción</th>
                <th scope="col">Tipo Cotrato</th>
                <th scope="col">Cargo</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Término</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($persona->contratos as $contrato)
                    <tr>
                        <td>{{ $contrato->descripcion}}</td>
                        <td>{{ $contrato->tipocontrato->tipocontrato }}</td>
                        <td>{{ $contrato->cargo->cargo }}</td>
                        <td>{{ $contrato->fechainicio}}</td>
                        <td>{{ $contrato->fechatermino}}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm" onclick="editarContrato({{ $contrato }});">Editar</button>
                            <!-- <a type="button" class="btn btn-success btn-sm" href="/personas/contrato/editar/{{ $persona->idpersona }}/{{ $contrato->idpcontrato }}">Editar</a> -->
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>


<!-- Button trigger modal
<button id="modalActivate" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalEdicion">
  Launch demo modal
</button>
-->
<!-- Modal -->
<div class="modal fade right" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="modalEdicionLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEdicionLabel">Contrato</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form class="p-3" method="POST" action="/personas/contrato/guardar">
            @csrf
            <input type="hidden" id="cont_idcontrato" name="idcontrato" value="" />
            <input type="hidden" id="cont_idpersona" name="idpersona" value="{{ $persona->idpersona }}" />

            <div class="row">
                <div class="md-form col-sm m-0">
                    <input name="descripcion" type="text" id="cont_descripcion" class="form-control" maxlength="150" required value="">
                    <label for="descripcion">Descripción</label>
                </div>
            </div>
            <div class="row">
                <div class="md-form col-sm m-0">
                    <select class="browser-default custom-select" id="cont_idtipocontrato" name="idtipocontrato">
                        @foreach ($tiposcontrato as $item)
                            <option value="{{ $item->idtipocontrato }}"
                                @if ($item->idtipocontrato == 0 /*$contrato->idtipocontrato*/)
                                    selected="true"
                                @endif
                                >{{ $item->tipocontrato }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md-form col-sm m-0">
                    <select class="browser-default custom-select" id="cont_idcargo" name="idcargo">
                        @foreach ($cargos as $item)
                            <option value="{{ $item->idcargo }}"
                                @if ($item->idcargo == 0 /*$contrato->idcargo*/)
                                    selected="true"
                                @endif
                                >{{ $item->cargo }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="row">
                <div class="md-form col-sm m-0">
                    <input placeholder="Fecha inicio" type="text" id="cont_fechainicio" name="fechainicio" class="form-control datepicker" value="" required="true">
                    <label for="fechainicioe">Fecha inicio</label>
                </div>
                <div class="md-form col-sm m-0">
                    <input placeholder="Fecha término" type="text" id="cont_fechatermino" name="fechatermino" class="form-control datepicker" value="" required="true">
                    <label for="fechatermino">Fecha término</label>
                </div>


            </div>
            <div class="row">
                <button type="submit" class="btn btn-success" id="cont_botonGuardar" name="botonGuardar">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </form>



      </div>
    </div>
  </div>
</div>
<!-- Modal -->



    @endif


</div>
@endsection


@section("javascript")
<script>
    $(document).ready( function () {
        $('#tabla').DataTable();
    } );

    function editarContrato(contrato)   {
        $("#cont_idcontrato").val(contrato.idpcontrato);
        $("#cont_descripcion").val(contrato.descripcion);
        $("#cont_fechainicio").val(contrato.fechainicio);
        $("#cont_fechatermino").val(contrato.fechatermino);
        $("#cont_idtipocontrato").val(contrato.idtipocontrato).change();
        $("#cont_idcargo").val(contrato.idcargo).change();

        $("#modalEdicion").modal();
    }


</script>
@endsection

