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

Auth::routes();

Route::get('/inicio', 'InicioController@inicio', [
    "user" => 'freddy'
])->name('inicio');

//HOME
Route::get('/home', 'HomeController@index')->name('home');
Route::get('create', 'HomeController@create');

Route::get('/callAddress', 'InicioController@callAddress')->name('callAddress');

Route::resource('/user', 'UserController');

//admin
/*Route::get('admin', function (){
  echo 'you are admin';
})->middleware('admin');*/
Route::get('admin', 'AdminController@index')->middleware('admin');