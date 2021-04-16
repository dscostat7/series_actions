@extends('layout')

@section('page')
Controle de Séries
@endsection

@section('cabecalho')
Séries
@endsection


@section('conteudo')
@include('mensagem', ['mensagem' => $mensagem])

@auth
    <a href="{{route('create')}}" class="btn btn-dark mb-2">Adicionar</a>
@endauth
<ul class="list-group">
    @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <img src="{{ $serie->capa_url }}" class="img-thumbnail" height="100px" width="100px">
                {{-- @if ($serie->capa != null)
                    <img src="http://localhost:8000/storage/capas/{{ $serie->capa }}" class="img-thumbnail" height="100px" width="100px">
                @else
                    <img src="http://localhost:8000/storage/capas/sem-imagem.jpg" class="img-thumbnail" height="100px" width="100px">
                @endif --}}
                
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
            </div>
            <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                <input type="text" class="form-control" value="{{ $serie->nome }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>

            <span class="d-flex">
                @auth
                    <button class="btn btn-info btn-sm mr-1" onclick="exibeEdicao({{ $serie->id }})">
                        <i class="fas fa-edit"></i>
                    </button>
                @endauth
                <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-1">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                @auth
                    <form method="post" action="/remover/{{ $serie->id }}" onsubmit="return confirm('Tem Certeza que deseja remover {{ $serie->nome }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form> 
                @endauth
            </span>
        </li>
    @endforeach
</ul>

<script>

    // Edição de nome da Serie;

    function exibeEdicao(serieId) {
        const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
        const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
        if (nomeSerieEl.hasAttribute('hidden')) {
            nomeSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
        inputSerieEl.removeAttribute('hidden');
        nomeSerieEl.hidden = true;
        }
    }

    function editarSerie(serieId) {
        let formData = new FormData();
        const nome = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
        const token = document.querySelector('input[name="_token"]').value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/series/${serieId}/editaNome`;
        fetch(url, {
            body: formData,
            method: 'POST'
        }).then(() => {
            exibeEdicao(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = nome;
        });
    }

    
</script>
@endsection