<?php

namespace App\Services;
use App\Serie;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Controllers\SeriesController;

class CriadorDeSeries {
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporada, ?string $capa): Serie {
        
        DB::beginTransaction();
            
            $serie = Serie::create (['nome' => $nomeSerie, 'capa' => $capa]);
            for ($t = 1; $t <= $qtdTemporadas; $t++) {
                $temporada = $serie->temporadas()->create(['numero' => $t]);

                for ($e = 1; $e <= $epPorTemporada; $e++) {
                    $temporada->episodios()->create(['numero' => $e]);
                }
            }
        DB::commit();
        return $serie;
    }
}