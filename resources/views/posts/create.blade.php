@extends('layouts.main')
@section('title','Criar '.$pagnome)
@section('content')
<div class="create-container">
    <h1>Criar {{$pagnome}}</h1>
    <form action="/{{$pagrota}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" />
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao"></textarea>
        </div>
        @if($pagnome == 'Notícias')
        <div class="form-group">
        <label for="tags">Tags:</label>
        <input type="text" class="form-control" id="tags" name="tags" />
        </div>
        @elseif($pagnome == 'Análises')
        <div class="form-group">
        <label for="anime">Anime:</label>
        <input type="text" class="form-control" id="anime" name="anime" />
        </div>
        <div class="form-group">
        <label for="episodio">Episodio:</label>
        <input type="text" class="form-control" id="episodio" name="episodio" />
        </div>
        @elseif($pagnome == 'Guias de Temporada')
        <div class="form-group">
        <label for="tags">Tags:</label>
        <input type="text" class="form-control" id="tags" name="tags" />
        </div>
        <div class="form-group">
        <label for="estacao">Estacao:</label>
        <select class="form-control" id="estacao" name="estacao">
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

        @endif
        @if(isset($categorias))
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <select class="form-control" id="categoria" name="categoria">
                @foreach($categorias as $categoria)
                <option name="{{$categoria->nome}}" value="{{$categoria->id}}">{{$categoria->nome}}</option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="form-group">
            <label for="image">Imagem da {{$pagnome}}:</label>
            <input type="file" name="image" id="image" class="form-control-file" />
        </div> 
        <button type="submit" class="btn btn-primary float-right">Registrar</button>
    </form>
</div>
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
<script>
  CKEDITOR.replace('descricao');
  var dropArea = document.querySelector('textarea[id="descricao"]');
  
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
