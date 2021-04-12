@extends('layout');

@section('page')
Episódios
@endsection

@section('cabecalho')
 Episódios {{-- de {{ $serie->nome }} --}}
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

    <form action="/temporada/{{ $temporadaId }}/episodios/assistir" method="POST">
        @csrf
        <ul class="list-group">
            @foreach ($episodios as $episodio)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio {{ $episodio->numero }}
                    <input type="checkbox" name="episodios[]" value="{{ $episodio->id }}" {{ $episodio->assistido ? 'checked' : '' }}>
                </li>
            @endforeach
        </ul>
        <button class="btn btn-primary mt-2 mb-2">Salvar</button>
        <a href="{{route('index')}}" class="btn btn-dark mt-2 mb-2">Home</a>
        <a href="{{route('index')}}" class="btn btn-dark mt-2 mb-2">Voltar</a>
    </form>
@endsection