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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/propietarios', 'PropietarioController@index')->name('propietarios.index');
Route::get('/propietarios/{id}', 'PropietarioController@show')->name('propietarios.show');
Route::get('/propietarios/{id}/terrenos', 'PropietarioController@terrenos')->name('propietarios.terrenos');
Route::get('/propietarios/{id}/vallas', 'PropietarioController@vallas')->name('propietarios.vallas');


Route::get('/terrenos', 'TerrenoController@index')->name('terrenos.index');
Route::get('/terrenos/{id}', 'TerrenoController@show')->name('terrenos.show');
Route::get('/terrenos/{id}/vallas', 'TerrenoController@show')->name('terrenos.show');


Route::get('/vallas', 'VallaController@index');
Route::get('/valla/datos/{id}', 'VallaController@valladatos');

Route::get('/agencias', 'AgenciaController@index')->name('agencias.index');
Route::get('/agencias/{id}', 'AgenciaController@show')->name('agencias.show');

Route::get('/clientes', 'ClienteController@index')->name('clientes.index');
Route::get('/clientes/{id}', 'ClienteController@show')->name('clientes.show');


Route::get('/contrato/datos/{id}', 'ContratoController@datos');
Route::get('/terreno/datos/{id}', 'TerrenoController@datos');


