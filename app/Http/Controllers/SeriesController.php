<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;

class SeriesController extends Controller
{
    public function index(Request $request) {
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        return view ('index', compact('series', 'mensagem'));
    }

    public function create (Request $request) {
        return view ('adicionar');

    }

    public function store (SeriesFormRequest $request) {

        
        $serie = Serie::create ($request->all());
        $request->session()->flash('mensagem', "Série $serie->nome, adicionada com Sucesso");
        
        return redirect()->route('index');
    }

    public function destroy (Request $request) {
        Serie::destroy($request->id);
        $request->session()->flash('mensagem', "Série removida com Sucesso");
        
        return redirect()->route('index');
    }
};
