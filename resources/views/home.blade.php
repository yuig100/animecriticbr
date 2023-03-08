@extends('layouts.main')
@section('title','Anime Critic Br')
@section('content')
<h1 style="display:none;"></h1>
<div class="home-section">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($noticias as $key => $noticia)
            @if($key < 5)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" class="@if($key == 0) active @endif" aria-current="true" aria-label="Slide {{$key+1}}"></button>
            @endif
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($noticias as $key => $noticia)
            @if($key < 5)
            <div class="carousel-item @if($key == 0) active @endif">
                <a href="/noticias/{{$noticia->link}}">
                    <img src="{{$noticia->image}}" class="d-block w-100" alt="{{$noticia->titulo}}" />
                    <div class="carousel-caption d-none d-md-block">
                        <h3>{{$noticia->titulo}}</h3>
                    </div>
                </a>
            </div>
            @endif
        @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="square-div">
        <div class="square card lugarum">
            @if(isset($oneguia))
            <a href="/guia-de-temporada/{{$oneguia->link}}">
                <img class="card-img-top" src="{{$oneguia->image}}" alt="{{$oneguia->titulo}}" />
                <div class="central-text">
                    <p>{{$oneguia->titulo}}</p>
                </div>
            </a>
            @else
            <img class="card-img-top" src="{{asset('img/itens/semassunto.png')}}" alt="sem assunto" />
            @endif
        </div>
        <div class="square card lugardois">
            @if(isset($onerankvendas))
            <a href="/noticias/{{$onerankvendas->link}}">
                <img class="card-img-top" src="{{$onerankvendas->image}}" alt="{{$onerankvendas->titulo}}" />
                <div class="central-text">
                    <p>{{$onerankvendas->titulo}}</p>
                </div>
            </a>
            @else
            <img class="card-img-top" src="{{asset('img/itens/semassunto.png')}}" alt="sem assunto" />
            @endif
        </div>
        <div class="square card lugartres">
            @if(isset($onerankJP))
            <a href="/noticias/{{$onerankJP->link}}">
                <img class="card-img-top" src="{{$onerankJP->image}}" alt="{{$onerankJP->titulo}}" />
                <div class="central-text">
                    <p>{{$onerankJP->titulo}}</p>
                </div>
            </a>
            @else
            <img class="card-img-top" src="{{asset('img/itens/semassunto.png')}}" alt="sem assunto" />
            @endif
        </div>
        <div class="square card lugarquatro">
            @if(isset($onerankBR))
            <a href="/noticias/{{$onerankBR->link}}">
                <img class="card-img-top" src="{{$onerankBR->image}}" alt="{{$onerankBR->titulo}}" />
                <div class="central-text">
                    <p>{{$onerankBR->titulo}}</p>
                </div>
            </a>
            @else
            <img class="card-img-top" src="{{asset('img/itens/semassunto.png')}}" alt="sem assunto" />
            @endif
        </div>
    </div>
</div>
<div class="news-section">
    <a href="/noticias">
        <h2>Noticias</h2>
    </a>
    <div class="row" id="section-row">
        @foreach($noticias as $noticia)

        <div id="card-tamanho" class="card" style="width: 18rem;">
            <a href="/noticias/{{$noticia->link}}">
                <img class="card-img-top" src="{{$noticia->image}}" alt="{{$noticia->titulo}}" />
            </a>
            <div class="card-body">
                <div>
                    <a href="/searchcat?query={{$noticia->categoria->nome}}">
                        <h5 class="inline">{{$noticia->categoria->nome}}</h5>
                    </a>
                    <h6 class="inline">{{date('d/m/Y',strtotime($noticia->created_at))}}</h6>
                </div>
                <a href="/noticias/{{$noticia->link}}">
                    <h4 class="card-title">{{$noticia->titulo}}</h4>
                </a>
                <p>{!! Str::words($noticia->descricao,20) !!}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<div class="news-section">
    <a href="/analises">
        <h2>Análises</h2>
    </a>
    <div class="row" id="section-row">
        @foreach($analises as $analise)
        <div id="card-tamanho" class="card" style="width: 18rem;">
            <a href="/analises/{{$analise->link}}">
                <img class="card-img-top" src="{{$analise->image}}" alt="{{$analise->titulo}}" />
            </a>
            <div class="card-body">
                <div>
                    <a href="/searchcat?query={{$analise->categoria->nome}}">
                        <h5 class="inline">{{$analise->categoria->nome}}</h5>
                    </a>
                    <h6 class="inline">{{date('d/m/Y',strtotime($analise->created_at))}}</h6>
                </div>
                <a href="/analises/{{$analise->link}}">
                    <h4 class="card-title">{{$analise->titulo}}</h4>
                </a>
                <p>{!! Str::words($analise->descricao,20) !!}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
