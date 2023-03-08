@extends('layouts.main')
@section('title','Buscas')

@section('content')
<section class="news-section">

    <h1>Buscas</h1>

    @if(isset($posts))
    <div class="row" id="section-row"> 
            @foreach($posts as $post)

            <div class="card" style="width: 18rem;">
                @if($post->id_categoria == 1 || $post->id_categoria >=4)
                <a href="/noticias/{{$post->link}}">
                    @elseif($post->id_categoria == 2)
                    <a href="/analises/{{$post->link}}">
                        @elseif($post->id_categoria == 3)
                        <a href="/guia-de-temporada/{{$post->link}}">
                            @else
                            <a href='#'>
                                @endif
                                <img class="card-img-top" src="{{$post->image}}" alt="{{$post->titulo}}" />
                            </a>
                            <div class="card-body">
                                <div>
                                    <a href="/searchcat?query={{ App\Models\Categoria::find($post->id_categoria)->nome }}">
                                        <h5 class="inline">{{ App\Models\Categoria::find($post->id_categoria)->nome }}</h5>
                                    </a>
                                    <h6 class="inline">{{date('d/m/Y',strtotime($post->created_at))}}</h6>
                                </div>
                                @if($post->id_categoria == 1 || $post->id_categoria >=4)
                                <a href="/noticias/{{$post->link}}">
                                    @elseif($post->id_categoria == 2)
                                    <a href="/analises/{{$post->link}}">
                                        @elseif($post->id_categoria == 3)
                                        <a href="/guia-de-temporada/{{$post->link}}">
                                            @endif
                                            <h4 class="card-title">{{$post->titulo}}</h4>
                                        </a>
                                        <p>{!! Str::words($post->descricao,20) !!}</p>
                            </div>
            </div>
            @endforeach
    </div>
    @else
    <div class="alert alert-success">{{ $msg }}</div>
    @endif
</section>
@if(isset($posts))
<div>
    <nav aria-label="..." class="arialabel">
        <ul class="pagination">
            <li class="page-item @if($posts->currentPage() == 1) disabled @endif">
                <a class="page-link" href="{{ $posts->previousPageUrl() }}">Anterior</a>
            </li>
            @for($i = 1; $i <= $posts->lastPage(); $i++)
                <li class="page-item @if($i == $posts->currentPage()) active @endif">
                    <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <li class="page-item @if($posts->currentPage() == $posts->lastPage()) disabled @endif">
                    <a class="page-link" href="{{ $posts->nextPageUrl() }}">Próximo</a>
                </li>
        </ul>
    </nav>
</div>
@endif
@endsection
