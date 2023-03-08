@extends('layouts.main')
@section('title','Calendario')
@section('content')
<div class="create-container">
    <h1>Ano</h1>
    <div class="info-anime calendario">
        @foreach($calendariosPorAno as $ano => $estacoes)
        <h2 class="">{{$ano}}</h2>
            <div>
                @foreach($estacoes as $estacao)
                <div class="botao">
                    <a href="/calendario/{{$ano}}/{{$estacao}}">{{$estacao}}</a>
                </div>
                @endforeach
            </div>
        <hr />
        @endforeach
    </div>
</div>
@endsection
