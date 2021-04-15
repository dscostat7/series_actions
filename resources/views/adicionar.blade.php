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
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col col-8">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control mb-3" name="nome" id="nome">
                </div>
                
                <div class="col col-2">
                    <label for="qtd_temporadas">Temporadas: </label>
                    <input type="number" class="form-control mb-3" name="qtd_temporadas" id="qtd_temporadas">
                </div>

                <div class="col col-2">
                    <label for="qtd_episodios">Episódios: </label>
                    <input type="number" class="form-control mb-3" name="qtd_episodios" id="qtd_episodios">
                </div>

            </div>

            <div class="row">
                <div class="col col-12">
                    <label for="nome">Capa: </label>
                    <input type="file" class="form-control mb-3" name="capa" id="capa">
                </div>
            </div>

            <button class="btn btn-primary mb-2">Adicionar</button>
        </form>
        <a href="{{route('index')}}" class="btn btn-dark mb-2">Voltar</a>
@endsection