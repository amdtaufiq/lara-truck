<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/truks', 'TruksController@index');
Route::post('/truks/store', 'TruksController@store');
Route::get('/truks/{id?}', 'TruksController@show');
Route::post('/truks/update/{id?}', 'TruksController@update');
Route::delete('/truks/{id?}', 'TruksController@destroy');

Route::get('/items', 'ItemsController@index');
Route::post('/items/store', 'ItemsController@store');
Route::get('/items/{id?}', 'ItemsController@show');
Route::post('/items/update/{id?}', 'ItemsController@update');
Route::delete('/items/{id?}', 'ItemsController@destroy');

Route::get('/rentals', 'RentalsController@index');
Route::post('/rentals/store', 'RentalsController@store');
Route::get('/rentals/{id?}', 'RentalsController@show');

Route::get('/cargos/{rental_id?}', 'CargosController@index');
Route::post('/cargos/store', 'CargosController@store');
Route::get('/cargos/{id?}', 'CargosController@show');
Route::post('/cargos/update/{id?}', 'CargosController@update');
Route::delete('/cargos/{id?}', 'CargosController@destroy');


