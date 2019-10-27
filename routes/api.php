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

Route::get('/superheroes', 'SuperheroesController@index')->name('superheroes.index');
Route::get('/superheroes/{id}', 'SuperheroesController@show')->name('superheroes.show');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
