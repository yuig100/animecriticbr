@extends('layouts.main')
@section('title','Editar Anime')
@section('content')
<div class="create-container">
    <h1>Criar Anime</h1>

    <form action="/animes/update/{{$animes->link}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{$animes->nome}}"/>
        </div>
        <div class="form-group">
            <label for="sinopse">Sinopse:</label>
            <textarea class="form-control" id="sinopse" name="sinopse">{{$animes->sinopse}}</textarea>
        </div>
        <div class="form-group">
            <label for="image">Imagem do Anime:</label>
            <input type="file" name="image" id="image" class="form-control-file" />
        </div>
        <div class="form-group">
        <label for="dia_da_semana">Dia da Semana:</label>
        <select class="form-control" id="dia_da_semana" name="dia_da_semana">
            <option name="" value=""></option>
            <option name="segunda" value="segunda" @if($animes->dia_da_semana == "segunda") selected @endif>Segunda</option>
            <option name="terca" value="terca" @if($animes->dia_da_semana == "terca") selected @endif>Terça</option>
            <option name="quarta" value="quarta" @if($animes->dia_da_semana == "quarta") selected @endif>Quarta</option>
            <option name="quinta" value="quinta" @if($animes->dia_da_semana == "quinta") selected @endif>Quinta</option>
            <option name="sexta" value="sexta" @if($animes->dia_da_semana == "sexta") selected @endif>Sexta</option>
            <option name="sabado" value="sabado" @if($animes->dia_da_semana == "sabado") selected @endif>Sábado</option>
            <option name="domingo" value="domingo" @if($animes->dia_da_semana == "domingo") selected @endif>Domingo</option>
        </select>
        </div>
        <button type="submit" class="btn btn-primary float-right">Postar</button>
        <button class="btn btn-danger float-left"><a style="text-decoration: none; color:white;" href="/animes/delete/{{$animes->link}}" onclick="return confirm('Tem certeza que deseja excluir este elemento?')">Excluir</a></button>
    </form>
</div>
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
  CKEDITOR.replace('sinopse');
  var dropArea = document.querySelector('textarea[id="sinopse"]');
  
  dropArea.addEventListener('drop', function(e) {
    e.preventDefault();
    var file = e.dataTransfer.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
      var image = new Image();
      image.src = e.target.result;
      CKEDITOR.instances.descricao.insertHtml('<img src="/img/imagem/' + image.src + '" />');
    };
    reader.readAsDataURL(file);
  });
  
  dropArea.addEventListener('dragover', function(e) {
    e.preventDefault();
  });
</script>

@endsection
