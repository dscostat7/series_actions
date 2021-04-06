<?php

Route::get('/', 'SeriesController@index')->name('index');
Route::get('/series', 'SeriesController@create')->name('create');
Route::post('/series', 'SeriesController@store')->name('store');
Route::delete('/remover/{id}', 'SeriesController@destroy')->name('destroy');