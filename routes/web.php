<?php

Route::get('/', 'SeriesController@index')->name('index');
Route::get('/series', 'SeriesController@create')->name('create');
Route::post('/series', 'SeriesController@store')->name('store');
Route::delete('/remover/{id}', 'SeriesController@destroy')->name('destroy');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')->name('series.editaNome');
Route::get('/series/{serieId}/temporadas', 'TemporadasController@index')->name('temporadas.index');