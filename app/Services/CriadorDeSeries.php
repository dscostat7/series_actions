<?php

namespace App\Services;
use App\Serie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class CriadorDeSeries {
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada): Serie {
        $serie = Serie::create (['nome' => $nomeSerie]);
        for ($t = 1; $t <= $qtdTemporadas; $t++) {
            $temporada = $serie->temporadas()->create(['numero' => $t]);

            for ($e = 1; $e <= $epPorTemporada; $e++) {
                $temporada->episodios()->create(['numero' => $e]);
            }
        }
        return $serie;
    }
}