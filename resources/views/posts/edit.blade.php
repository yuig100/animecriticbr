@extends('layouts.main')
@section('title','Editar '.$pagnome)

@section('content')
<div class="create-container">
    <h1>Editando: {{$post->titulo}}</h1>
    <form action="/{{$pagrota}}/update/{{$post->link}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{$post->titulo}}"/>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao">{{$post->descricao}}</textarea>
        </div>
        @if($pagnome == 'Análises')
        <div class="form-group">
            <label for="anime">Anime:</label>
            <input type="text" class="form-control" id="anime" name="anime" value="{{$post->anime}}"/>
        </div>
        <div class="form-group">
            <label for="episodio">Episodio:</label>
            <input type="text" class="form-control" id="episodio" name="episodio" value="{{$post->episodio}}"/>
        </div>
        @else
        <div class="form-group">
            <label for="tags">Tags:</label>
            <input type="text" class="form-control" id="tags" name="tags" value="{{$post->tags}}"/>
        </div>
        @endif
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select class="form-control" id="categoria" name="categoria" value="{{$post->id_categoria}}">
                @foreach($categorias as $categoria)
                <option name="{{$categoria->nome}}" value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>
        @if($pagnome == 'Guias de Temporada')
        <div class="form-group">
            <label for="estacao">Estacao:</label>
            <input type="text" class="form-control" id="estacao" name="estacao" value="{{$post->estacao}}"/>
        </div>
        <div class="form-group">
            <label for="ano">Ano:</label>
            <input type="text" class="form-control" id="ano" name="ano" value="{{$post->ano}}"/>
        </div>
        @endif
        <div class="form-group">
            <label for="image">Imagem da {{$pagnome}}:</label>
            <input type="file" name="image" id="image" class="form-control-file" />
        </div> 
        <button type="submit" class="btn btn-primary float-right">Postar</button>
        <button class="btn btn-danger float-left"><a style="text-decoration: none; color:white;" href="/{{$pagrota}}/delete/{{$post->link}}" onclick="return confirm('Tem certeza que deseja excluir este elemento?')">Excluir</a></button>
    </form>
</div>

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('descricao');
</script>
@endsection
