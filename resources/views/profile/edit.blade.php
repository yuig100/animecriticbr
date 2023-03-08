@extends('layouts.profile')
@section('title','Editar Perfil')
@section('content')
<div class="container">
    <div class="edit-perfil">
        <form method="POST" action="/profile/edit" enctype="multipart/form-data">
            @csrf
            <div class="col-12">

                <div class="form-group">
                    <div class="image-user">
                        <img src="{{Auth::user()->image}}"/>
                        <input class="form-control-file" type="file" name="image" id="image">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nome" class="col-form-lavel">Editar seu Nome:</label>
                    <input class="form-control @error('nome') is-invalid @enderror" type="text" id="nome" name="nome" value="{{ Auth::user()->nome }}" />
                    @error('nome')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="bio" class="col-form-lavel">Editar sua Biografia:</label>
                    <input class="form-control @error('bio') is-invalid @enderror" type="text" id="bio" name="bio" value="{{ Auth::user()->bio }}" />
                    @error('bio')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="localizacao" class="col-form-lavel">Editar sua Localização:</label>
                    <input class="form-control @error('localizacao') is-invalid @enderror" type="text" id="localizacao" name="localizacao" value="{{ Auth::user()->localizacao}}"  />
                    @error('localizacao')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
            <div class="form-group">
                <label for="genero" class="col-form-label">Seu Gênero:</label>
                <select class="form-control" id="genero" name="genero">
                    <option value="1" @if(Auth::user()->genero == "1") selected @endif>Masculino</option>
                    <option value="0" @if(Auth::user()->genero == "0") selected @endif>Feminino</option>
                    <option value="NULL" @if(Auth::user()->genero == "null") selected @endif>Helicóptero Apache</option>
                </select>
            </div>
            </div>
            <div class="justify-content-center">
                <button type="submit" id="salvar" class="btn btn-primary" disabled>Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
$('input').on('change', function() {
  $('#salvar').prop('disabled', false);
    });

    $('#formulario').on('submit', function(e) {
  e.preventDefault();

  // faz a requisição AJAX para enviar as alterações para o servidor
  $.ajax({
    url: '/editar-usuario',
    type: 'POST',
    data: $(this).serialize(),
    success: function(data) {
      alert('Alterações salvas com sucesso!');
      $('#salvar').prop('disabled', true);
    },
    error: function(xhr, textStatus, errorThrown) {
      alert('Ocorreu um erro ao salvar as alterações.');
      console.error(errorThrown);
    }
  });
});
</script>
@endsection
