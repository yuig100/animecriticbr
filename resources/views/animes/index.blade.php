@extends('layouts.main')
@section('title','Animes')
@section('content')

<section class="news-section">
    <a href="/animes">
        <h1>Animes</h1>
    </a>
    <div class="search-bar" style="margin-bottom:10px;">
        <form action="{{ route('anime-search') }}" method="GET">
            <input type="text" name="query" placeholder="Buscar Animes" />
            <button type="submit" style="margin-top:5px;">Search</button>
        </form>
    </div>
    @if(isset($animes))
    <div class="row" id="section-row">
        @foreach($animes as $anime)
        <div id="card-tamanho" class="card" style="width: 18rem;">
            <a href="/animes/{{$anime->link}}">
                <img class="card-img-top" src="{{$anime->image}}" alt="{{$anime->nome}}" />
            </a>
            <div class="card-body">
                <a href="/animes/{{$anime->link}}">
                    <h4 class="card-title">{{$anime->nome}}</h4>
                </a>
                <p>{!! Str::words($anime->sinopse,20) !!}</p>
            </div>
        </div>
        @endforeach
        <div>
            <nav aria-label="..." class="arialabel">
                <ul class="pagination">
                    <li class="page-item @if($animes->currentPage() == 1) disabled @endif">
                        <a class="page-link" href="{{ $animes->previousPageUrl() }}">Anterior</a>
                    </li>
                    <li class="page-item @if($animes->currentPage() != 1) disabled @endif">
                        <a class="page-link" href="{{ $animes->url(1) }}">1</a>
                    </li>
                    @if($animes->currentPage() > 3)
                    <li class="page-item disabled">
                        <a class="page-link">...</a>
                    </li>
                    @endif
                    @for($i = max(2, $animes->currentPage() - 1); $i <= min($animes->
                        lastPage() - 1, $animes->currentPage() + 1); $i++)
                        <li class="page-item @if($i == $animes->currentPage()) active @endif">
                            <a class="page-link" href="{{ $animes->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor
                    @if($animes->currentPage() < $animes->lastPage() - 2)
                        <li class="page-item disabled">
                            <a class="page-link">...</a>
                        </li>
                        @endif
                        <li class="page-item @if($animes->currentPage() != $animes->lastPage()) disabled @endif">
                            <a class="page-link" href="{{ $animes->url($animes->lastPage()) }}">{{ $animes->lastPage() }}</a>
                        </li>
                        <li class="page-item @if($animes->currentPage() == $animes->lastPage()) disabled @endif">
                            <a class="page-link" href="{{ $animes->nextPageUrl() }}">Próximo</a>
                        </li>
                </ul>
            </nav>
        </div>
    </div>
    @else
    <div class="alert alert-success">{{ $msg }}</div>
    @endif
</section>

@endsection
