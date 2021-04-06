@extends('layout')

@section('page')
Adicionar Séries
@endsection

@section('cabecalho')
Adicionar Série
@endsection

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome: </label>
                <input type="text" class="form-control mb-3" name="nome" id="nome">

                {{-- <label for="temp">Quantas Temporadas: </label>
                <input type="text" class="form-control mb-3" name="temp" id="temp"> --}}

            </div>
            <button class="btn btn-primary mb-2">Adicionar</button>
        </form>
        <a href="{{route('index')}}" class="btn btn-dark mb-2">Voltar</a>
@endsection