@extends('layouts.main')
@section('title',$post->titulo)

@section('content')
<div class="col-md-10 offset-md-1 noticia-container">
    <div class="row">

        <div class="corpo-post">
            <h1>{{$post->titulo}}</h1>
            <hr />
            {!! $post->descricao !!}
        </div>
        <div class="tags-post">
            <h5>
                @if(isset($post->tags))
            Tags:<a href="/searchtag?query={{$post->tags}}">{{$post->tags}}</a>
                @else
            Tags:<a href="/searchtag?query={{$post->anime}}">{{$post->anime}}</a>
                @endif
            </h5>
        </div>
        <hr />
        <div class="user-post">
        @if(isset($post->id_user))
        <a href="/profile/{{App\Models\User::find($post->id_user)->nickname}}"><img src="{{App\Models\User::find($post->id_user)->image}}" /></a>
        <h4>Materia por: {{ App\Models\User::find($post->id_user)->nome }} -
        @if(date('d/m/Y H:i', strtotime($post->updated_at)) <= date('d/m/Y H:i', strtotime($post->created_at)))
        Criado em: {{date('d/m/Y H:i', strtotime($post->created_at))}}
        @else
        Editado em: {{date('d/m/Y H:i', strtotime($post->updated_at))}}
        @endif
        </h4>
        @else
        <h4>SEM AUTOR -
        @if(date('d/m/Y H:i', strtotime($post->updated_at)) <= date('d/m/Y H:i', strtotime($post->created_at)))
        Criado em: {{date('d/m/Y H:i', strtotime($post->created_at))}}
        @else
        Editado em: {{date('d/m/Y H:i', strtotime($post->updated_at))}}
        @endif
        </h4>
        @endif

        @if(Auth()->user())
        @if($post->id_user == Auth()->user()->id)
        <a href="/{{$pagrota}}/edit/{{$post->link}}"><button>Editar</button></a>
        @endif
        @endif
        </div>
    </div>
    <hr />
    <x-disqus></x-disqus>
</div>
@endsection
