@extends('layouts.main')
@section('title','Criar Calendario')
@section('content')
<div class="create-container">
    <h1>Criar Calendario</h1>
    <form action="/calendario" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nome_anime">Nome do Anime:</label>
            <input type="nome_anime" class="form-control" id="nome_anime" name="nome_anime" />
        </div>
        <div class="form-group">
        <label for="estacao">Estacao:</label>
        <select class="form-control" id="estacao" name="estacao">
            <option name="" value=""></option>
            <option name="inverno" value="inverno">Inverno</option>
            <option name="primavera" value="primavera">Primavera</option>
            <option name="verao" value="verao">Verão</option>
            <option name="outono" value="outono">Outono</option>
        </select>
        </div>
        <div class="form-group">
        <label for="ano">Ano:</label>
        <input type="number" class="form-control" id="ano" name="ano" />
        </div>
        <button type="submit" class="btn btn-primary float-right">Registrar</button>
    </form>
</div>
@endsection
