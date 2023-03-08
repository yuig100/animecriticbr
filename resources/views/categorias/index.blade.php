@extends('layouts.main')
@section('title','Categorias')
@section('content')
<div class="create-container">
    <div>
        <a href="/categoria/create">
            <button class="btn btn-success">Criar uma Data</button>
        </a>
    </div>
    <div class="row">
        <div>
            <table class="table">
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr>
                        <td>
                            {{$categoria->id}}
                        </td>
                        <td>
                            {{$categoria->nome}}
                        </td>
                        <td>
                            {{$categoria->descrição}}
                        </td>
                        <td>
                            <a href="/categoria/edit/{{$categoria->id}}">
                                <button class="btn btn-primary">Editar</button>
                            </a>
                        </td>
                        <td>
                            <a href="/categoria/delete/{{$categoria->id}}" onclick="return confirm('Tem certeza que deseja excluir este elemento?')">
                                <button class="btn btn-danger">Excluir</button>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
