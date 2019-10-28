<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', 'WelcomeController@index')->name('welcome.index');
Route::get('/superheroes', 'SuperheroesController@index')->name('superheroes.index');
Route::get('/superheroes/{id}', 'SuperheroesController@show')->name('superheroes.show');
Route::put('/superheroes/{id}', 'SuperheroesController@update')->name('superheroes.update');
