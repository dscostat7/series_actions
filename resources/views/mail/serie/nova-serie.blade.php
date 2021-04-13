@component('mail::message') 
{{-- Estilizando a pagina de email com o markdown --}}

# Nova Série
### {{ $nome }}
### {{ $qtdTemporadas }} Temporadas com {{ $qtdEpisodios }} episódios!

@endcomponent