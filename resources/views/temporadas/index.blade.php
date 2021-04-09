@extends('layout')

@section('page')
Controle de Séries - Temporadas
@endsection

@section('cabecalho')
Temporadas de {{ $serie->nome }}
@endsection

@section('conteudo')
    <ul class="list-group">
        @foreach ($temporadas as $temporada)
            <li class="list-group-item">Temporada {{ $temporada->numero }}</li>
        @endforeach
    </ul>
    <a href="{{route('index')}}" class="btn btn-dark mb-2">Voltar</a>
@endsection