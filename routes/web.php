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

Auth::routes();

//Inicio Controller
Route::get('/', 'InicioController@inicio');
Route::get('/inicio', 'InicioController@inicio')->name('inicio');
Route::get('/callAddress', 'InicioController@callAddress')->name('callAddress');

//Transferencia Controlador
Route::get('/addressFull', 'TransferenciaController@addressFull')->name('addressFull');
Route::post('/addressFullCallApi', 'TransferenciaController@addressFullCallApi')->name('addressFullCallApi');
Route::post('/transaccion', 'TransferenciaController@microTransaccion')->name('transaccion');
Route::get('/viewTransaccion', 'TransferenciaController@viewMicroTransaccion')->name('viewTransaccion');
Route::get('/balanceAddress', 'TransferenciaController@balanceAddress')->name('balanceAddress');

Route::post('/addressSearchApi', 'InicioController@addressSearchApi')->name('addressSearchApi');
//Route::view('contentPanel', 'transferencia.contentPanel', ['user'=> ['uno', "dos"]]);
//admin middleware
//Route::get('admin', function (){ echo 'you are admin'; })->middleware('admin');
Route::get('admin', 'AdminController@index')->middleware('admin');