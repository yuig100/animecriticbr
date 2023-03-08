@extends('layouts.main')
@section('title','Calendario')
@section('content')
<div class="create-container">
    <h1>Estacao</h1>
    <div>
        @foreach($calendarios as $calendario)
        <button>
            <a href="/calendario/{{$calendario->ano}}/{{$calendario->estacao}}">{{$calendario->estacao}}</a>
        </button>
        @endforeach
    </div>
</div>
@endsection
