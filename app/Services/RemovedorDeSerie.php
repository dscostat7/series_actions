<?php

namespace App\Services;
use App\{Serie, Temporada, Episodio};
use Illuminate\Support\Facades\DB;
use Storage;
use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;

class RemovedorDeSerie {
    public function removerSerie (int $serieId ): string {

        $nomeSerie = '';
        DB::transaction(function () use ($serieId, &$nomeSerie) {

            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $serieObj = (object) $serie->toArray();


            $serie->temporadas->each(function (Temporada $temporada) {
                $temporada->episodios->each(function (Episodio $episodio) {
                    $episodio->delete();
                });
                $temporada->delete();
            });
            $serie->delete();

            $evento = new SerieApagada($serieObj);
            event($evento);
            ExcluirCapaSerie::dispatch($serieObj);
        });

        return $nomeSerie;
    }
}