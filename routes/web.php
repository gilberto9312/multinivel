<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vendedor', 'VendedorController@index');
Route::post('/vendedor-create', 'VendedorController@store');

Route::get('/ventas-vendedor', 'VentasVendedorController@index');
Route::post('/ventas-create', 'VentasVendedorController@store');
Route::post('/comision-vendedor', 'VentasVendedorController@metaPropia');


