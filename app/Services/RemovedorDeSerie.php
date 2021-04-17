<?php

namespace App\Services;
use App\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;
use Storage;
use App\Events\SerieApagada;

class RemovedorDeSerie {
    public function removerSerie (int $serieId ): string {

        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {

            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $serie->temporadas->each(function (Temporada $temporada) {
                $temporada->episodios->each(function (Episodio $episodio) {
                    $episodio->delete();
                });
                $temporada->delete();
            });
            $serie->delete();

            $evento = new SerieApagada($serie);
            event($evento);
        });

        return $nomeSerie;
    }
}