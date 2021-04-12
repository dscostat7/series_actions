<?php


Route::get('/home', 'SeriesController@index')->name('index');
Route::get('/series', 'SeriesController@create')->name('create');
Route::post('/series', 'SeriesController@store')->name('store');
Route::delete('/remover/{id}', 'SeriesController@destroy')->name('destroy');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')->name('series.editaNome');
Route::get('/series/{serieId}/temporadas', 'TemporadasController@index')->name('temporadas.index');
Route::get('/temporada/{temporada}/episodios', 'EpisodiosController@index')->name('temporada.episodios');
Route::post('/temporada/{temporada}/episodios/assistir', 'EpisodiosController@assistir')->name('episodios.assistir');

Auth::routes();

Route::get('/inicio', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index')->name('entrar.login');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registro', 'RegistroController@create');
Route::post('/registro', 'RegistroController@store');