@extends('layouts.profile')
@section('title',$user->name)
@section('content')
          <div class="navbar-user">
              <div class="user-name">
                  <h2>{{$user->nome}}</h2>
              </div>
              <div class="user-image">
                  <img src="{{$user->image}}" />
              </div>
              <div class="user-seguidores">
                  <div>
                  <p>Posts:</p>
                  <h3>{{$contpost}}</h3>
                  </div>
              </div>
              <div class="user-info">
                  @if($user->genero == NULL)
                  <p>Genero: </p>
                  @elseif($user->genero == 1)
                  <p>Genero: Masculino</p>
                  @elseif($user->genero == 0)
                  <p>Genero: Feminino</p>
                  @endif
                  <p>Local: {{$user->localizacao}}</p>
                  <p>Entrou em: {{date('d/m/Y',strtotime($user->created_at))}}</p>
                  @if($user->tipo == 0)
                  <p>Normal</p>
                  @elseif($user->tipo == 1)
                  <p>Moderador</p>
                  @elseif($user->tipo == 2)
                  <p>Editor</p>
                  @elseif($user->tipo == 3)
                  <p>Administrador</p>
                  @endif
              </div>
              <div class="admin-functions">
                  @if($user->id == auth()->user()->id)
                      @if($user->tipo == 0)
                      @endif
                      @if($user->tipo == 1)
                      @endif
                      @if($user->tipo >= 2)
                        <a href="/noticias/create"><button>Criar Noticia</button></a>
                        <a href="/analises/create"><button>Criar Analise</button></a>
                        <a href="/guia-de-temporada/create"><button>Criar Guia de Temporada</button></a>
                      @endif
                      @if($user->tipo >= 3)
                        <a href="/animes/create"><button>Criar Anime</button></a>
                        <a href="/categoria"><button>Criar Categoria</button></a>
                        <a href="#"><button>Editar Usuarios</button></a>
                      @endif
                  @endif
              </div>
          </div>
          <div id="content">
          <div class="user-central">
              <div class="user-bio">
              <h2>Minha Bio:</h2>
              <p>{!! $user->bio !!}</p>
              </div>
              <div class="user-cometarios">
              @foreach($posts as $post)
              <div class="user-comentario">
                <h3>{{$post->titulo}}</h3>
                <p>{!! Str::words($post->descricao,20)!!}</p>
                  @if(Auth()->user())
                  @if($post->id_user == Auth()->user()->id)
                  <a href="/noticias/edit/{{$post->link}}"><button>Editar</button></a>
                  @endif
                  @endif
              </div>
              @endforeach
              </div> 
          </div>
          </div>
@endsection
