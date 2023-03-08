@extends('layouts.main')
@section('title','Criar Anime')
@section('content')
<div class="create-container">
    <h1>Criar Anime</h1>

    <form action="/animes" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" />
        </div>
        <div class="form-group">
            <label for="sinopse">Sinopse:</label>
            <textarea class="form-control" id="sinopse" name="sinopse"></textarea>
        </div>
        <div class="form-group">
        <label for="dia_da_semana">Dia da Semana:</label>
        <select class="form-control" id="dia_da_semana" name="dia_da_semana">
            <option name="" value=""></option>
            <option name="segunda" value="segunda">Segunda</option>
            <option name="terca" value="terca">Terça</option>
            <option name="quarta" value="quarta">Quarta</option>
            <option name="quinta" value="quinta">Quinta</option>
            <option name="sexta" value="sexta">Sexta</option>
            <option name="sabado" value="sabado">Sabado</option>
            <option name="domingo" value="domingo">Domingo</option>
        </select>
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
        <div class="form-group">
            <label for="image">Imagem do Anime:</label>
            <input type="file" name="image" id="image" class="form-control-file" />
        </div> 
        <button type="submit" class="btn btn-primary float-right">Registrar</button>
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
