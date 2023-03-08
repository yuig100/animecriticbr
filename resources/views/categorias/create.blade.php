@extends('layouts.main')
@section('title','Criar Categoria')
@section('content')
<div class="create-container">
    <h1>Criar Categoria</h1>
    <form action="/categoria" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" />
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" />
        </div>
        <button type="submit" class="btn btn-primary float-right">Registrar</button>
    </form>
</div>
@endsection
