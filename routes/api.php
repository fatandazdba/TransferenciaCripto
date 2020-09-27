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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//Transferencia
Route::get('addressFull', 'TransferenciaApiController@addressFull');
Route::get('balanceAddress', 'TransferenciaApiController@balanceAddress');
Route::get('transactionHashEndpoint', 'TransferenciaApiController@transactionHashEndpoint');
Route::post('address', 'TransferenciaApiController@address');
Route::post('microTransferencia', 'TransferenciaApiController@microTransferencia');
Route::post('updateUser', 'UserApiController@updateUser');

//User
Route::post('createTransferencia', 'UserApiController@createTransferencia');