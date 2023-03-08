@extends('layouts.main')
@section('title',$pagnome)

@section('content')
<section class="news-section">
    <a href="/{{$pagrota}}">
        <h1>{{$pagnome}}</h1>
    </a>
    <div class="row" id="section-row">
        @foreach($posts as $post)

        <div id="card-tamanho" class="card" style="width: 18rem;">
            @if($pagnome == 'Notícias')
            <a href="/{{$pagrota}}/{{$post->link}}">
                @elseif($pagnome == 'Análises')
                <a href="/{{$pagrota}}/{{ str_replace(" ", "-", $post->
                    anime) }}/{{$post->episodio}}">
            @elseif($pagnome == 'Guias de Temporada')
                    <a href="/{{$pagrota}}/{{$post->link}}">
                        @endif
                        <img class="card-img-top" src="{{$post->image}}" alt="{{$post->titulo}}" />
                    </a>
                    <div class="card-body">
                        <div>
                            <a href="/searchcat?query={{$post->categoria->nome}}">
                                <h5 class="inline">{{$post->categoria->nome}}</h5>
                            </a>
                            <h6 class="inline">{{date('d/m/Y',strtotime($post->created_at))}}</h6>
                        </div>
                        @if($pagnome == 'Notícias')
                        <a href="/{{$pagrota}}/{{$post->link}}">
                            @elseif($pagnome == 'Análises')
                            <a href="/{{$pagrota}}/{{$post->link}}">
                                @elseif($pagnome == 'Guias de Temporada')
                                <a href="/{{$pagrota}}/{{$post->link}}">
                                    @endif
                                    <h4 class="card-title">{{$post->titulo}}</h4>
                                </a>
                                <p>{!! Str::words($post->descricao,20) !!}</p>
</div>
</div>
        @endforeach
        <div>
            <nav aria-label="..." class="arialabel">
                <ul class="pagination">
                    <li class="page-item @if($posts->currentPage() == 1) disabled @endif">
                        <a class="page-link" href="{{ $posts->previousPageUrl() }}">Anterior</a>
                    </li>
                    <li class="page-item @if($posts->currentPage() != 1) disabled @endif">
                        <a class="page-link" href="{{ $posts->url(1) }}">1</a>
                    </li>
                    @if($posts->currentPage() > 3)
                    <li class="page-item disabled">
                        <a class="page-link">...</a>
                    </li>
                    @endif
                    @for($i = max(2, $posts->currentPage() - 1); $i <= min($posts->
                        lastPage() - 1, $posts->currentPage() + 1); $i++)
                        <li class="page-item @if($i == $posts->currentPage()) active @endif">
                            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                        </li>
                        @endfor
                    @if($posts->currentPage() < $posts->lastPage() - 2)
                        <li class="page-item disabled">
                            <a class="page-link">...</a>
                        </li>
                        @endif
                        <li class="page-item @if($posts->currentPage() != $posts->lastPage()) disabled @endif">
                            <a class="page-link" href="{{ $posts->url($posts->lastPage()) }}">{{ $posts->lastPage() }}</a>
                        </li>
                        <li class="page-item @if($posts->currentPage() == $posts->lastPage()) disabled @endif">
                            <a class="page-link" href="{{ $posts->nextPageUrl() }}">Próximo</a>
                        </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
@endsection
