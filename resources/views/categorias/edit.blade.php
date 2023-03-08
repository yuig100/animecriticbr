@extends('layouts.main')
@section('title','Editar Categoria')
@section('content')
<div class="create-container">
    <h1>Editar Categoria</h1>
    <form action="/categoria/edit/{{$categoria->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{$categoria->nome}}" />
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{$categoria->descrição}}" />
        </div>
        <button type="submit" class="btn btn-primary float-right">Registrar</button>
    </form>
</div>
@endsection
