@extends('layouts.main')
@section('title',$animes->nome)
@section('content')
<section class="info-anime">
    <div>
        <h1>{{$animes->nome}}</h1>
    </div>
    <div>
        <img src="{{ $animes->image }}" />
    </div>
    <div>
        {!! $animes->sinopse !!}
    </div>
    @foreach($reviews as $review)
    <div class="info-review">
        <a href="/analises/{{$review->link}}" >Análises : {{$review->anime}} - Episodio {{$review->episodio}}</a>
    </div>
    @endforeach

    @if(Auth()->user())
        @if(Auth()->user()->tipo >= 2)
        <div>
            <a href="/animes/edit/{{$animes->link}}">
                <button>Editar</button>
            </a>
            <a href="/calendario/show/{{$animes->link}}">
                <button>Calendario</button>
            </a>
        </div>
        @endif
    @endif

</section>
@endsection
