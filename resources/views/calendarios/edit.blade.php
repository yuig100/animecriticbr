@extends('layouts.main')
@section('title','Editar Calendario')
@section('content')

<div class="create-container">

    <form action="/calendario/update/{{$anime_calendario->id}}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
        <label for="estacao">Estacao:</label>
        <select class="form-control" id="estacao" name="estacao" value="{{$anime_calendario->estacao}}">
            <option name="" value=""></option>
            <option name="inverno" value="inverno">Inverno</option>
            <option name="primavera" value="primavera">Primavera</option>
            <option name="verao" value="verao">Verão</option>
            <option name="outono" value="outono">Outono</option>
        </select>
        </div>
        <div class="form-group">
        <label for="ano">Ano:</label>
        <input type="number" class="form-control" id="ano" name="ano" value="{{$anime_calendario->ano}}"/>
        </div>
        <button type="submit" class="btn btn-primary float-right">Registrar</button>
    </form>
</div>
@endsection
