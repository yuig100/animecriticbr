@extends('layouts.main')
@section('title','Calendario de '.$estacao.' de '.$ano)
@section('content')

<div class="table table-responsive">
    <table class="calendar-table">
        <thead>
            <tr>
                <th>Segunda</th>
                <th>Terça</th>
                <th>Quarta</th>
                <th>Quinta</th>
                <th>Sexta</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach (['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado', 'domingo'] as $dia_da_semana)
                <td>
                    @if (isset($calendarios[$dia_da_semana]))
                    @foreach ($calendarios[$dia_da_semana] as $calendario)
                    <div class="calendar-cedula calendar-cell">
                        <a href="/animes/{{$calendario->link}}">
                            <img src="{{ $calendario->image}}" alt="{{ $calendario->nome_anime }}" />
                            <p>{{ $calendario->nome_anime }}</p>
                        </a>
                    </div>
                    <hr />
                    @endforeach
                @endif
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
@endsection

@section('script')
<script>
const cells = document.querySelectorAll('.calendar-cell');
let maxHeight = 0;
cells.forEach(cell => {
  const height = cell.offsetHeight;
  if (height > maxHeight) {
    maxHeight = height;
  }
});
cells.forEach(cell => {
  cell.style.height = maxHeight + 'px';
});
</script>
@endsection
