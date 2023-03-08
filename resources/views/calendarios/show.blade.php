@extends('layouts.main')
@section('title',$anime_calendarios[0]->nome_anime)
@section('content')
<div class="info-anime">
    <h1>{{$anime_calendarios[0]->nome_anime}}</h1>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ $anime_calendarios[0]->image }}" alt="{{ $anime_calendarios[0]->nome_anime }}" />
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead class="thead-dark">
                    <th>Dia</th>
                    <th>Estação</th>
                    <th>Ano</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </thead>
                <tbody>
                    @foreach($anime_calendarios as $anime_calendario)
                    <tr>
                        <td>
                            {{$anime_calendario->dia_da_semana}}
                        </td>
                        <td>
                            {{$anime_calendario->estacao}}
                        </td>
                        <td>
                            {{$anime_calendario->ano}}
                        </td>
                        <td>
                            <a href="/calendario/edit/{{$anime_calendario->id}}">
                                <button class="btn btn-primary">Editar</button>
                            </a>
                        </td>
                        <td>
                            <a href="/calendario/delete/{{$anime_calendario->id}}" onclick="return confirm('Tem certeza que deseja excluir este elemento?')">
                                <button class="btn btn-danger">Excluir</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                <a href="/calendario/create">
                    <button class="btn btn-success">Criar uma Data</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
