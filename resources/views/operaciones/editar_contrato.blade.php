@extends('layouts.app')

@section('content')

<div class="container">
    <h2>
        Contrato
    </h2>

    <form class="border border-light p-5" method="POST" action="/personas/contrato/guardar">
        @csrf
        <input type="hidden" id="idcontrato" name="idcontrato" value="{{ $contrato->idpcontrato }}" />
        <input type="hidden" id="idpersona" name="idpersona" value="{{ $idpersona }}" />

        <div class="row">
            <div class="md-form col-sm m-0">
                <input name="descripcion" type="text" id="descripcion" class="form-control" maxlength="150" required value="{{ $contrato->descripcion }}">
                <label for="descripcion">Descripción</label>
            </div>
        </div>
        <div class="row">
            <div class="md-form col-sm m-0">
                <select class="browser-default custom-select" id="idtipocontrato" name="idtipocontrato">
                    @foreach ($tiposcontrato as $item)
                        <option value="{{ $item->idtipocontrato }}"
                            @if ($item->idtipocontrato == $contrato->idtipocontrato)
                                selected="true"
                            @endif
                            >{{ $item->tipocontrato }}</option>
                    @endforeach
                </select>
            </div>
            <div class="md-form col-sm m-0">
                <select class="browser-default custom-select" id="idcargo" name="idcargo">
                    @foreach ($cargos as $item)
                        <option value="{{ $item->idcargo }}"
                            @if ($item->idcargo == $contrato->idcargo)
                                selected="true"
                            @endif
                            >{{ $item->cargo }}</option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row">
            <div class="md-form col-sm m-0">
                <input placeholder="Fecha inicio" type="text" id="fechainicio" name="fechainicio" class="form-control datepicker" value="{{ $contrato->fechainicio }}" required="true">
                <label for="fechainicioe">Fecha inicio</label>
            </div>
            <div class="md-form col-sm m-0">
                <input placeholder="Fecha término" type="text" id="fechatermino" name="fechatermino" class="form-control datepicker" value="{{ $contrato->fechatermino }}" required="true">
                <label for="fechatermino">Fecha término</label>
            </div>


        </div>
        <div class="row">
            <button type="submit" class="btn btn-success" id="botonGuardar" name="botonGuardar">Guardar</button>
            <a type="button" class="btn btn-default" href="/personas/editar/{{ $idpersona }}">Cancelar</a>
        </div>
    </form>
</div>


@endsection
